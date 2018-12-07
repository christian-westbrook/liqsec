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

    // Check if the user entered matching passwords
    if($_POST['password'] == $_POST['confirm'])
    {
        // Get the user information provided through POST
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $fname    = $_POST['fname'];
        $lname    = $_POST['lname'];
        $key      = $_POST['key'];

        // Check to see if the device key exists
        header( "Location: ../register.php?error=1" );
    }

    /*include 'database.php';
    $sql = 'INSERT INTO USERS (ROLE_ID, EMAIL, PASSWORD, FNAME, LNAME) VALUES (:ROLE_ID, :EMAIL, :PASSWORD, :FNAME, :LNAME)';
    $stmt = conn->prepare($sql);*/

?>
