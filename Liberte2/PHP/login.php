<?php
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	
	$user = new User();
	$try = $user->login($_POST['email'], $_POST['senha']);

	if($try){
		$_SESSION['user'] = serialize($user);
		echo 1;
	}
	else echo $_POST['email'].' '.$_POST['senha'];
	include '../PHP/endConnect.php';
?>