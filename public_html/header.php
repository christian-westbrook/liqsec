<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Landing page for LiqSec.
    // =========================================================================

    // Import statements
    include 'session.php';
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
    <?php
    if($sessionStarted == true)
    {
    ?>
        <a class="item left" id="home" href="index.php"><p>LiqSec</p></a>
        <a class="item left" id="dashboard" href="dashboard.php"><p>Dashboard</p></a>
        <a class="item right" id="logout" href="php/logout-script.php"><p>Log Out</p></a>

    <?php
    }
    else
    {
    ?>
        <a class="item left" id="home" href="index.php"><p>LiqSec</p></a>
        <a class="item right" id="reg" href="register.php"><p>Sign Up</p></a>
        <a class="item right" id="auth" href="auth.php"><p>Log In</p></a>
    <?php
    }
    ?>
</div>
