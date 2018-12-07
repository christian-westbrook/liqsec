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

    include 'header.php';

    if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }
?>

<div id="container">
    <h1>Dashboard</h1>
</div>

<?php
    include 'footer.php';
?>
