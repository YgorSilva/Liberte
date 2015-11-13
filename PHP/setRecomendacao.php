<?php 
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['isUndoing']) $sql = 'insert recomendacoes (materia, usuario) 
		values ('.$_POST["matId"].' ,'.$userData['id'].')';
	else $sql = 'delete from recomendacoes
		where materia = "'.$_POST['matId'].'" and usuario = '.$userData['id'];
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include '../PHP/endConnect.php';
?>