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
        $stmt = conn->prepare($sql);
        $stmt->bindParam(":DEV_KEY", $devkey, PDO::PARAM_INT);

        if($stmt->execute())
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($results)
            {
                $sql = 'INSERT INTO USERS (ROLE_ID, EMAIL, PASSWORD, FNAME, LNAME) VALUES (3, :EMAIL, :PASSWORD, :FNAME, :LNAME)';
                $stmt = conn->prepare($sql);
                $stmt->bindParam(":EMAIL", $email, PDO::PARAM_STR);
                $stmt->bindParam(":PASSWORD", $ciphertext, PDO::PARAM_STR);
                $stmt->bindParam(":FNAME", $fname, PDO::PARAM_STR);
                $stmt->bindParam(":LNAME", $lname, PDO::PARAM_STR);

                if($stmt->execute())
                {
                    header( "Location: ../dashboard.php");
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
