<?php
	$con = mysql_connect("mysql.hostinger.com", "u925071396_ygor", "aPehaq") or die ("Erro de conexão</br>".mysql_error());
	$db = mysql_select_db("u925071396_lbrt", $con) or die ("Erro de conexão</br>".mysql_error());
	mysql_set_charset('utf8', $con);
	session_start();
?>