<?php
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';
	
	$user = new User();
	$try = $user->login($_GET['email'], $_GET['pw']);

	if($try){
		$_SESSION['user'] = serialize($user);
		echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
	}
	else{
		$try = $user->checkEmail($_GET['email']);
		echo $try?'error_0':'error_1';
	}
	include 'endConnect.php';
?>