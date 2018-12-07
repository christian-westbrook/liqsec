<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Landing page for LiqSec.
    // =========================================================================
?>

<head>
    <title>LiqSec</title>
    <meta charset="utf-8">

    <!-- Stylesheet links -->
    <link rel="stylesheet" type="text/css" href="css/header.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" />

    <!-- Font links -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <?php
    	// Generates css links
    	foreach($css as $key => $value)
    	{
    		echo '<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />';
    	}
    	// Generates js links
    	foreach($js as $key => $value)
    	{
    		echo '<script src="js/' . $value . '.js"></script>';
    	}
	?>
</head>

<div id="header">
    <a class="item" id="home" href="index.php"><p>LiqSec</p></a>
</div>
