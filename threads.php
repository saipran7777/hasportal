<?php
		include 'config.php';
		// echo " :::::: "+$type+"  :::::   ";
		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$stmt = $conn->prepare("SELECT * from threads");
		$stmt->execute();
		while($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
		$created = $row["created_at"];
		$created1 = explode(" ",$created);
		$date = explode("-",$created1[0]);
		$time = explode(":",$created1[1]);
		$arr[]=array("thread_id"=>$row["thread_relation"],"subject"=>$row['subject'],"user"=>$row["user_id"],"date"=>$date[2]."-".$date[1],"time"=>$time[0].":".$time[1],"body"=>$row["body"]);
		}
		echo json_encode($arr);
	
?>