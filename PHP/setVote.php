<?php 
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['isUndoing'] && !$_POST['isUpdating']) $sql = 'insert aprovardesaprovar (materia, usuario, isPositivo) 
		values ('.$_POST["matId"].' ,'.$userData['id'].', '.$_POST['isPositive'].')';
	else if($_POST['isUpdating']) $sql = 'update aprovardesaprovar set isPositivo = '.$_POST['isPositive'].'
	 	where materia = '.$_POST['matId'].' and usuario = '.$userData['id'];
	else $sql = 'delete from aprovardesaprovar 
		where materia = '.$_POST['matId'].' and usuario = '.$userData['id'];
	$rs = mysql_query($sql);
	echo $rs? true:false;
	
	include '../PHP/endConnect.php';
?>