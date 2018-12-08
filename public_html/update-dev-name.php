<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : update-dev-name.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Allows the user to update the name of a device.
    // =========================================================================

    $css = array(
				    0 => 'update-dev-name'
	    	    );

    include 'header.php';

	if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }
?>

<div id="container">
	<p id="label">Update Device Pin</p>
	<form action="php/update-dev-name-script.php" method="POST" >
		<input type="text" name="devid" placeholder="Device ID" class="field" /></br>
		<input type="text" name="name" placeholder="New Name" class="field" /></br>
		<input type="submit" value="Update" class="field "/>
	</form>

	<?php
        if($_GET['error'] == '1')
        {
            echo '<p id="error"><b>Unable to contact LiqSec servers</b></p>';
        }
		else if($_GET['message'] == 1)
		{
			echo '<p id="message"><b>Update request sent</b></p>';
		}
    ?>
</div>

<?php
    include 'footer.php';
?>
