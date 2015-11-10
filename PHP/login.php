<?php
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';
	
	$user = new User();
	$try = $user->login($_POST['email'], $_POST['senha']);

	if($try){
		$_SESSION['user'] = serialize($user);
		echo 1;
	}
	include 'endConnect.php';
?>