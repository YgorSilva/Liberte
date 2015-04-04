<?php 
	include 'connect.php';

	if($_GET['isSigning']) $sql = 'insert assinaturas values ("'.$_GET["subscriber"].'","'.$_GET['signed'].'")';
	else $sql = 'delete from assinaturas where assinante = "'.$_GET['subscriber'].'" and assinado = "'.$_GET['signed'].'"';
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include 'endConnect.php';
?>