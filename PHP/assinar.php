<?php 
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if($_POST['isSigning']) $sql = 'insert assinaturas (assinante, assinado) values ("'.$userData['email'].'","'.$_POST['signed'].'")';
	else $sql = 'delete from assinaturas where assinante = "'.$userData['email'].'" and assinado = "'.$_POST['signed'].'"';
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include 'endConnect.php';
?>