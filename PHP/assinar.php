<?php 
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['signed']) $sql = 'insert assinaturas (assinante, assinado) values ("'.$userData['id'].'","'.$_POST['user'].'")';
	else $sql = 'delete from assinaturas where assinante = "'.$userData['id'].'" and assinado = "'.$_POST['user'].'"';
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include 'endConnect.php';
?>