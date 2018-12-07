<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : index.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Landing page for LiqSec.
    // =========================================================================

    $css = array(
				    0 => 'index'
	    	    );

    include 'header.php';
?>

<div id="container">
    <h1 id="slogan"><b>Redefining liquid security.</b></h1>
    <div id="get-started"><a href="register.php"><p>Get Started</p></a></div>
</div>

<?php
    include 'footer.php';
?>
