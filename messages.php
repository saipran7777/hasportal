<?php
	if(isset($_POST['thread_id'])) {
		try {
		include 'config.php';
		$thread_id=$_POST['thread_id'];
		// echo " :::::: "+$type+"  :::::   ";
		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$stmt = $conn->prepare("SELECT * from messages where message_relation=:type1");
		$stmt-> bindParam(":type1",$thread_id);
		$stmt->execute();
		while($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
		$created = $row["created_at"];
		$created1 = explode(" ",$created);
		$date = explode("-",$created1[0]);
		$time = explode(":",$created1[1]);

		$arr[]=array("body"=>$row['body'],"date"=>$date[2]."-".$date[1],"time"=>$time[0].":".$time[1]);
		}
		echo json_encode($arr);
		} catch (PDOException $e) {
			echo $e;
		}

  }
?>
