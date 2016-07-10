<?php
	if( isset($_POST['thread_id']) && isset($_POST['message'])){
		include 'config.php';
		$thread_id= $_POST['thread_id'];
		$message= $_POST['message'];
		// echo " :::::: "+$type+"  :::::   ";
		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$stmt2 = $conn->prepare("INSERT INTO `messages`(`body`,`user_id`,`message_relation`) VALUES (:type11,:type12,:type13)");
		$stmt2-> bindParam(":type11",$message);
		$stmt2-> bindParam(":type12",$a=0);
		$stmt2-> bindParam(":type13",$thread_id);
		$stmt2->execute();
		
  }
?>
