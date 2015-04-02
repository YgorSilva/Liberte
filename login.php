<?php
	include 'PHP/connect.php';
	include 'PHPClasses/userClass.php';
	$sql = 'select * from usuarios where email = "'.$_POST["email"].'" and senha = "'.$_POST["senha"].'"';
	$rs = mysql_query($sql, $con);
	if($rs){
		$reg = mysql_fetch_array($rs);
		$_SESSION['user'] = $reg['email'];
		include 'PHP/endConnect.php';
		echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
	}
	else{
		echo "<meta http-equiv='refresh' content='0;URL=index.php?login_error=true'>";
		include 'PHP/endConnect.php';
	}
?>