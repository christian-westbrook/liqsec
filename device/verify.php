<?php
	function run($oz)
	{
		openValve();
		sleep($oz);
		closeValve();
	}

	function openValve()
	{
		// TODO
	}

	function closeValve()
	{
		// TODO
	}

	if($argc == 3)
	{
		$host     = 'code.cis.uafs.edu';
		$username = 'iot3';
		$dbpass = 'IOT3210TY';
		$dbname   = 'iot3';
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$plaintext = $argv[1];
		$devid = $argv[2];
		$oz = $argv[3];

		$sql = 'SELECT PIN FROM DEVICES WHERE DEVICE_ID = :DEV_ID';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':DEV_ID', $devid, PDO::PARAM_INT);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$ciphertext = $results[0]['PIN'];

		 if(password_verify($plaintext, $ciphertext))
		 {
			 run($oz);
		 }
	}
?>
