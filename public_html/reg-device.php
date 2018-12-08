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

    <?php
        if($_GET['error'] == '1')
        {
            echo '<p id="error"><b>Invalid device key</b></p>';
        }
        else if($_GET['error'] == '2')
        {
            echo '<p id="error"><b>Unable to contact LiqSec servers</b></p>';
        }
    ?>
</div>

<?php
    include 'footer.php';
?>
