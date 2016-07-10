		<?php
		require 'config.php';
	$sub=$_GET["sub"];
	$body=$_GET["body"];
		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $conn->prepare("INSERT INTO threads (user_id,subject) VALUES (:type1,:type2)");
		$stmt-> bindParam(":type1",$a=0);
		$stmt-> bindParam(":type2",$sub);
		$stmt->execute();


		$stmt1 = $conn->prepare("SELECT `id` FROM `threads` WHERE `user_id`= :type01 AND `subject`=:type02");
		$stmt1-> bindParam(":type01",$a=0);
		$stmt1-> bindParam(":type02",$sub);
		$stmt1->execute();
		$thread= $stmt1->fetch(PDO::FETCH_ASSOC);

		$stmt2 = $conn->prepare("INSERT INTO `messages`(`body`,`user_id`, `thread_id`) VALUES (:type11,:type12,:type13)");
		$stmt2-> bindParam(":type11",$body);
		$stmt2-> bindParam(":type12",$a=0);
		$stmt2-> bindParam(":type13",$thread["id"]);
		$stmt2->execute();
		?>