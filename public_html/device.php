<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : device.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Displays a report on a particular device
    // =========================================================================

    $css = array(
				    0 => 'device'
	    	    );

    include 'header.php';
	include 'database.php';

	if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }

	if(isset($_GET['devid']))
	{
		$sql = 'SELECT * FROM DEVICES WHERE DEVICE_ID = :DEV_ID AND USER_ID = :USER_ID';
		$stmt = conn->prepare($sql);
		$stmt->bindParam(":DEV_ID", $_GET['devid'], PDO::PARAM_INT);
		$stmt->bindParam(':USER_ID', $_SESSION['USER_ID'], PDO::PARAM_INT);
		if($stmt->execute())
		{
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$_POST['DEV_ID'] = $results[0]['DEVICE_ID'];
			$_POST['NAME'] = $results[0]['NAME'];
			$_POST['ACTIVATE'] = $reuslts[0]['ACTIVATE'];
			$_POST['OWNER'] = $_SESSION['FNAME'] . ' ' . $_SESSION['LNAME'];

			
		}
		else
		{
			if(closeSession())
			{
				header('Location: /~iot3/');
			}
		}
	}
	else
	{
		if(closeSession())
		{
			header('Location: /~iot3/');
		}
	}
?>

<div id="container">
</div>

<?php
    include 'footer.php';
?>
