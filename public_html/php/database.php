<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : database.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Contains a template for connecting to the LiqSec database.
    // =========================================================================

<?php
	$host     = 'localhost';
	$username = 'iot3';
	$password = 'IOT3210TY';
	$dbname   = 'iot3';
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo "HERE";
?>
