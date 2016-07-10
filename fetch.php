<?php
	if(isset($_GET['type1'])) {
		try {
		include 'config.php';
		$type=$_GET['type1'];
		// echo " :::::: "+$type+"  :::::   ";
		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$stmt = $conn->prepare("SELECT * from list where type=:type1");
		$stmt-> bindParam(":type1",$type);
		$stmt->execute();
		while($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
		$arr[]=array("name"=>$row['name']);
		}
		echo json_encode($arr);
		} catch (PDOException $e) {
			echo $e;
		}

  }
?>
