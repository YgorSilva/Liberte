<?php
	include 'liberte.890m.com/PHP/connect.php';
	include 'liberte.890m.com/PHPClasses/userClass.php';
	
	$user = new User();
	$try = $user->login($_POST['email'], $_POST['senha']);

	if($try){
		$_SESSION['user'] = serialize($user);
		echo 1;
	}
	include 'liberte.890m.com/PHP/endConnect.php';
?>