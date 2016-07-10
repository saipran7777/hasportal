<?php
if(isset($_POST["body"])) {
	
	$sub=$_POST["sub"];
	$body=$_POST["body"];
	require 'phpmailer/PHPMailerAutoload.php';
	require "phpmailer/class.phpmailer.php";
	require 'config.php';
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'devunurisaipraneeth@gmail.com';                 // SMTP username
	$mail->Password = 'saipra07';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
//	$mail->SMTPDebug = 2;
	$mail->setFrom('devunurisaipraneeth@gmail.com', 'Sai Praneeth');
	$mail->addAddress('ce14b016@smail.iitm.ac.in','Sai Praneeth');     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Complaint:'.$sub;
	$mail->Body    = $body;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: '. $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';

	    $randomString =generateRandomString();

		$conn= new PDO("mysql:host=$servername;dbname=$database;charset:utf8",$username,$password);
		$conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $conn->prepare("INSERT INTO threads (user_id,subject,thread_relation,body) VALUES (:type1,:type2,:type3,:type4)");
		$stmt-> bindParam(":type1",$a=0);
		$stmt-> bindParam(":type2",$sub);
		$stmt-> bindParam(":type3",$randomString);
		$stmt-> bindParam(":type4",$body);
		$stmt->execute();

		$stmt2 = $conn->prepare("INSERT INTO `messages`(`body`,`user_id`, `message_relation`) VALUES (:type11,:type12,:type13)");
		$stmt2-> bindParam(":type11",$body);
		$stmt2-> bindParam(":type12",$a=0);
		$stmt2-> bindParam(":type13",$randomString);
		$stmt2->execute();

	}
}
else echo "Enter all details";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>