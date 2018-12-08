<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : update-dev-name-script.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Script that allows a user to update a device name.
    // =========================================================================

    // Import statements
    include 'database.php';
    include '../session.php';

	if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }

	// Get info through POST
	$devid = $_POST['devid'];
	$name = $_POST['name'];

	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);
	$sql = 'UPDATE DEVICES SET NAME = :NAME WHERE DEVICE_ID = :DEV_ID AND USER_ID = :USER_ID';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":NAME", $name, PDO::PARAM_STR);
	$stmt->bindParam(":DEV_ID", $devid, PDO::PARAM_INT);
	$stmt->bindParam(":USER_ID", $_SESSION['USER_ID'], PDO::PARAM_INT);
	if($stmt->execute())
	{
		header( "Location: ../update-dev-name.php?message=1" );
	}
	else
	{
		header( "Location: ../update-dev-name.php?error=1" );
	}
?>
