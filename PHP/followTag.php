<?php 
	include '/PHP/connect.php';
	include '/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if($_POST['isUndoing']) $sql = 'delete from tag_assinatura 
		where usuario = '.$userData['id'].' and tag = "'.$_POST['tag'].'"';
	else $sql = 'insert tag_assinatura values ('.$userData['id'].',"'.$_POST['tag'].'")';
	$rs = mysql_query($sql);
	echo $sql;

	include '/PHP/endConnect.php';
?>