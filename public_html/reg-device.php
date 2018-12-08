<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : reg-device.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Registers a new device with LiqSec
    // =========================================================================

    $css = array(
				    0 => 'reg-device'
	    	    );

    include 'header.php';
?>

<div id="container">
    <p id="label">Register Device</p>

    <form action="php/reg-device-script.php" method="POST">
        <input type="text" name="devkey" placeholder="Device Key" class="field" /></br>
        <input type="submit" value="Register" class="field" />
    </form>
</div>

<?php
    include 'footer.php';
?>
