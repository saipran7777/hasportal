<?php 
	if (isset($_POST["token"])) {
		require 'config.php';
		$fcmtoken = $_POST["token"];
		echo $fcmtoken;

		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $conn->prepare("INSERT INTO users (fcmtoken) VALUES (:type1)");
		$stmt-> bindParam(":type1",$fcmtoken);
		$stmt->execute();

	}
 ?>