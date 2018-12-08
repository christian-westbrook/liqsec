<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : login-script.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Script that allows a user to register an account with
    //              LiqSec.
    // =========================================================================

    // Import statements
    include 'database.php';
    include 'session.php';

    // Check if the user entered matching passwords
    if($_POST['password'] == $_POST['confirm'])
    {
        // Get the user information provided through POST
        $email      = $_POST['email'];
        $plaintext  = $_POST['password'];
        $ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);
        $fname      = $_POST['fname'];
        $lname      = $_POST['lname'];
        $devkey     = $_POST['devkey'];

        // Check to see if the device key exists
        $sql = 'SELECT DEVICE_ID FROM DEVICES WHERE DEV_KEY = :DEV_KEY';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":DEV_KEY", $devkey, PDO::PARAM_INT);

        if($stmt->execute())
        {
            $keyresults = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($keyresults)
            {
                $sql = 'INSERT INTO USERS (ROLE_ID, EMAIL, PASSWORD, FNAME, LNAME) VALUES (3, :EMAIL, :PASSWORD, :FNAME, :LNAME)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":EMAIL", $email, PDO::PARAM_STR);
                $stmt->bindParam(":PASSWORD", $ciphertext, PDO::PARAM_STR);
                $stmt->bindParam(":FNAME", $fname, PDO::PARAM_STR);
                $stmt->bindParam(":LNAME", $lname, PDO::PARAM_STR);

                if($stmt->execute())
                {
                    $sql = 'SELECT USER_ID FROM USERS WHERE EMAIL = :EMAIL';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":EMAIL", $email, PDO::PARAM_STR);

                    if($stmt->execute())
                    {
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $id = $results[0]['USER_ID'];
                        $devid = $keyresults[0]['DEVICE_ID'];

                        $sql = 'UPDATE DEVICES SET USER_ID = :USER_ID, ACTIVATE = NOW() WHERE DEVICE_ID = :DEV_ID';
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(":USER_ID", $id, PDO::PARAM_INT);
                        $stmt->bindParam(":DEV_ID", $devid, PDO::PARAM_INT);

                        if($stmt->execute())
                        {
                            $info['USER_ID'] 	= $id;
                            $info['ROLE_ID']	= '3';
                            echo 'HERE';
                            createSession($info);
                            $_SESSION['FNAME'] = $fname;
                            $_SESSION['LNAME'] = $lname;
                            header( "Location: ../dashboard.php" );
                        }
                        else
                        {
                            header( "Location: ../register.php?error=1" );
                        }
                    }
                    else
                    {
                        header( "Location: ../register.php?error=1" );
                    }
                }
                else
                {
                    header( "Location: ../register.php?error=2" );
                }
            }
            else
            {
                header( "Location: ../register.php?error=1" );
            }
        }
    }
?>
