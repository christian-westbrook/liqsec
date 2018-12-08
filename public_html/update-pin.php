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
	<form action="update-pin-script.php" method="POST" >
	</form>
</div>

<?php
    include 'footer.php';
?>
