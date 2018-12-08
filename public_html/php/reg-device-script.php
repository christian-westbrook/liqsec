<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : reg-device-script.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Script that allows a user to register a new device.
    // =========================================================================

    // Import statements
    include 'database.php';
    include '../session.php';

	$devkey = $_POST['devkey'];

    if($devkey == 0)
    {
        header( "Location: ../register.php?error=1" );
    }

	// Check to see if the device key exists
	$sql = 'SELECT DEVICE_ID FROM DEVICES WHERE DEV_KEY = :DEV_KEY';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":DEV_KEY", $devkey, PDO::PARAM_INT);

	if($stmt->execute())
	{
		$keyresults = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($keyresults)
		{
			$id = $_SESSION['USER_ID'];

			$sql = 'UPDATE DEVICES SET USER_ID = :USER_ID, ACTIVATE = NOW(), KEY = "" WHERE DEVICE_ID = :DEV_ID';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":USER_ID", $id, PDO::PARAM_INT);
			$stmt->bindParam(":DEV_ID", $devid, PDO::PARAM_INT);

			if($stmt->execute())
			{
				header( "Location: ../dashboard.php" );
			}
			else
			{
				header( "Location: ../reg-device.php?error=2" );
			}
		}
		else
		{
			header( "Location: ../reg-device.php?error=1" );
		}
	}
	else
	{
		header( "Location: ../reg-device.php?error=2" );
	}