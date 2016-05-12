<?php
	ini_set('display_errors', 'Off').
	$con = mysql_connect("mysql.hostinger.com", "u451817007_ygor", "despirocar") or die ("Erro de conexão</br>".mysql_error());
	$db = mysql_select_db("u451817007_lbrt", $con) or die ("Erro de conexão</br>".mysql_error());
	mysql_set_charset('utf8', $con);
	session_start();
?>