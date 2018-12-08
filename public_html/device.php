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
	include 'php/database.php';

	if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }

	if(isset($_GET['devid']))
	{
		$sql = 'SELECT * FROM DEVICES WHERE DEVICE_ID = :DEV_ID AND USER_ID = :USER_ID';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":DEV_ID", $_GET['devid'], PDO::PARAM_INT);
		$stmt->bindParam(':USER_ID', $_SESSION['USER_ID'], PDO::PARAM_INT);

		if($stmt->execute())
		{
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$_POST['DEV_ID'] = $results[0]['DEVICE_ID'];
			$_POST['NAME'] = $results[0]['NAME'];
			$_POST['ACTIVATE'] = $results[0]['ACTIVATE'];
			$_POST['OWNER'] = $_SESSION['FNAME'] . ' ' . $_SESSION['LNAME'];

			$sql = 'SELECT * FROM LOGS WHERE DEVICE_ID = :DEV_ID';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":DEV_ID", $_GET['devid'], PDO::PARAM_INT);
			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_POST['LOGS'] = $results;
			}
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

	// Time formatter function
    function formatDateTime($datetime)
    {
    	$year = substr($datetime, 0, 4);
    	$month = substr($datetime, 5, 2);
    	$day = substr($datetime, 8, 2);
    	$time = substr($datetime, 11, 8);
    	switch ($month)
    	{
    		case "01": 	$month = 'Jan.';
    		 			break;
    		case "02": $month = 'Feb.';
    					break;
    		case "03": $month = 'Mar.';
    					break;
    		case "04": $month = 'Apr.';
    					break;
    		case "05":	$month = 'May';
    					break;
    		case "06":	$month = 'June';
    					break;
    		case "07": 	$month = 'July';
    					break;
    		case "08":	$month = "Aug.";
    					break;
    		case "09":	$month = "Sep.";
    					break;
    		case "10":	$month = "Oct.";
    					break;
    		case "11":	$month = "Nov.";
    					break;
    		case "12":	$month = "Dec.";
    					break;
    	}
    	$formatted = $month . ' ' . $day . ', ' . $year . ' ' . $time;
    	return $formatted;
    }
?>

<div id="container">
	<?php
		$devid = $_POST['DEV_ID'];
		$name =  $_POST['NAME'];
		$activated = formatDateTime($_POST['ACTIVATE']);
		$owner = $_POST['OWNER'];
		$logs = $_POST['LOGS'];

		echo '<p id="info"><b>Device ID:</b> ' . $devid . '</br>';
		echo '<b>Name:</b> ' . $name . '</br>';
		echo '<b>Owner:</b> ' . $owner . '</br>';
		echo '<b>Activated:</b> ' . $activated . '</br></p>';

        $length = count($logs);
        for($i = 0; $i < $length; $i++)
        {
            echo '<p class="log"><b>Log ID:</b> ' . $logs[$i]['LOG_ID'] . ' </br><b>Log Time:</b> ' . formatDateTime($logs[$i]['LOG_TIME']) . '</p>';
        }
	?>
</div>

<?php
    include 'footer.php';
?>
