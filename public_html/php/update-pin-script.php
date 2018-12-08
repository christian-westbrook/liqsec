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
	$pin = $_POST['pin'];

	// Check to see if the PIN is valid
	if(strlen($pin) == 8 && ctype_digit($pin))
	{
		header( "Location: ../update-pin.php" );
	}
	else
	{
		header( "Location: ../update-pin.php?error=2" );
	}

?>
