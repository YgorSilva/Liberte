<?php 
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['isUndoing'] && !$_POST['isUpdating']) $sql = 'insert aprovarDesaprovar (materia, usuario, isPositivo) 
		values ('.$_POST["matId"].' ,'.$userData['id'].', '.$_POST['isPositive'].')';
	else if($_POST['isUpdating']) $sql = 'update aprovarDesaprovar set isPositivo = '.$_POST['isPositive'].'
	 	where materia = '.$_POST['matId'].' and usuario = '.$userData['id'];
	else $sql = 'delete from aprovarDesaprovar 
		where materia = '.$_POST['matId'].' and usuario = '.$userData['id'];
	$rs = mysql_query($sql);
	echo $rs? true:false;
	
	include 'endConnect.php';
?>