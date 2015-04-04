<?php
	include 'PHP/connect.php';
	include 'PHPClasses/userClass.php';
	
	$user = new User();
	$try = $user->login($_POST['email'], $_POST['senha']);

	if($try){
		$_SESSION['user'] = serialize($user);
		include 'PHP/endConnect.php';
		echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
	}
	else{
		include 'PHP/endConnect.php';
		echo "<meta http-equiv='refresh' content='0;URL=index.php?login_error=true'>";
	}
?>