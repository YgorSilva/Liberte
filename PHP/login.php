<?php
	$sql = 'select * from usuario where email = "'.$_POST["email"].'" and senha = "'.$_POST["senha"].'"';
	$rs = mysql_query($sql, $con);
	if($rs){
		session_start();
		$reg = mysql_fetch_array($rs);
		$_SESSION['email'] = $reg['email'];
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	}
	else{
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?login_error=true'>";
	}
?>