<?php
	include 'PHP/connect.php';
	include 'PHPClasses/.userClass.php';
	$user = new User();
	$rs = $user->insertData();
	if($rs){
		session_start();
		$_SESSION['email'] = $_POST['email'];
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}
	else{
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastro.php?err=1'>";
	}
	include 'PHP/endConnect.php';
?>