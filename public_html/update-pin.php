<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : update-pin.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Allows the user to update the PIN of a device.
    // =========================================================================

    $css = array(
				    0 => 'update-pin'
	    	    );

    include 'header.php';

	if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }
?>

<div id="container">
	<p id="label">Update Device Pin</p>
	<form action="update-pin-script.php" method="POST" >
		<input type="text" name="devid" placeholder="Device ID" class="field" /></br>
		<input type="password" name="pin" placeholder="Eight digit PIN" class="field" /></br>
		<input type="submit" value="Update" class="field "/>
	</form>

	<?php
        if($_GET['error'] == '1')
        {
            echo '<p id="error"><b>Invalid device ID</b></p>';
        }
        else if($_GET['error'] == '2')
        {
            echo '<p id="error"><b>Invalid PIN</b></p>';
        }
		else if($_GET['error'] == '3')
        {
            echo '<p id="error"><b>Unable to contact LiqSec servers</b></p>';
        }
    ?>
</div>

<?php
    include 'footer.php';
?>
