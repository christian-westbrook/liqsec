<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : dashboard.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Member center for LiqSec
    // =========================================================================

    $css = array(
				    0 => 'dashboard'
	    	    );

    // Import statements
    include 'header.php';
    include 'php/database.php';

    if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }

    $sql = 'SELECT * FROM DEVICES WHERE USER_ID = :USER_ID';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":USER_ID", $_SESSION['USER_ID'], PDO::PARAM_INT);

    if($stmt->execute())
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_POST['devices'] = $results;
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
    <h1>Dashboard</h1>

    <?php
        $devices = $_POST['devices'];

        $length = count($devices);
        for($i = 0; $i < $length; $i++)
        {
            echo '<div class="device"><p class="devname"><b>Device ID:</b> ' . $devices[$i]['DEVICE_ID'] . '</br><b>Name:</b> ' . $devices[$i]['NAME'] . ' </br><b>Activated:</b> ' . formatDateTime($devices[$i]['ACTIVATE']) . '</p></div>';
        }
    ?>

    <div class="device"><p id="reg"><b>Register new device</b></p><img src="img/add.png"></div>
</div>

<?php
    include 'footer.php';
?>
