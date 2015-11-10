<?php
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';

	$user = new User();
	$rs = $user->insertData();
	if($rs){
		$log = $user->login($_POST['email'], $_POST['senha']);
		if($log) $_SESSION['user'] = serialize($user);
	} 
	echo $rs;
	include 'endConnect.php';
?>