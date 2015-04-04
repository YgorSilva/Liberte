<?php 
	include 'connect.php';

	if($_GET['function'] == 'insert') $sql = 'insert aprovarDesaprovar values ("'.$_GET["matId"].'","'.$_GET['user'].'","'.$_GET['type'].'")';
	else if($_GET['function'] == 'undo') $sql = 'delete from aprovarDesaprovar where materia = "'.$_GET['matId'].'" and usuario = "'.$_GET['user'].'"';
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include 'endConnect.php';
?>