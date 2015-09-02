<?php
	$con = mysql_connect("localhost", "root", "") or die ("Erro de conexão</br>".mysql_error());
	$db = mysql_select_db("liberte", $con) or die ("Erro de conexão</br>".mysql_error());
	mysql_set_charset('utf8', $con);
	session_start();
?>