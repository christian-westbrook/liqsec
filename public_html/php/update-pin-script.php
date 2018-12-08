<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : update-pin-script.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Script that allows a user to update a device PIN.
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
	$plaintext = $_POST['pin'];

	// Check to see if the PIN is valid
	if(strlen($plaintext) == 8 && ctype_digit($plaintext))
	{
		$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);
		$sql = 'UPDATE DEVICES SET PIN = :PIN WHERE DEVICE_ID = :DEV_ID AND USER_ID = :USER_ID';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":PIN", $ciphertext, PDO::PARAM_STR);
		$stmt->bindParam(":DEV_ID", $devid, PDO::PARAM_INT);
		$stmt->bindParam(":USER_ID", $_SESSION['USER_ID'], PDO::PARAM_INT);
		$stmt->execute();
		header( "Location: ../update-pin.php?message=1" );
	}
	else
	{
		header( "Location: ../update-pin.php?error=2" );
	}

?>
