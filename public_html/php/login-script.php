<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : login-script.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Script that allows a user to log in to LiqSec.
    // =========================================================================

    // Import statements
    include 'database.php';

    // Get the user information provided through POST
    $email      = $_POST['email'];
    $plaintext  = $_POST['password'];

    $sql  = 'SELECT USER_ID, PASSWORD, ROLE_ID FROM USERS WHERE EMAIL= :EMAIL';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
    if($stmt->execute())
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($results && password_verify($plaintext, $results[0]['PASSWORD']))
        {
            $info['USER_ID'] 	= $results[0]['USER_ID'];
            $info['ROLE_ID']	= $results[0]['ROLE_ID'];
            createSession($info);
            header( "Location: ../dashboard.php" );
        }
        else
        {
            header( "Location: ../auth.php?error=2" );
        }
    }
    else
    {
        header( "Location: ../auth.php?error=1" );
    }
?>
