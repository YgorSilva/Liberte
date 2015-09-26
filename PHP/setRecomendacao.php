<?php 
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['isUndoing']) $sql = 'insert recomendacoes (materia, usuario) 
		values ('.$_POST["matId"].' ,"'.$userData['email'].'")';
	else $sql = 'delete from recomendacoes
		where materia = "'.$_POST['matId'].'" and usuario = "'.$userData['email'].'"';
	$rs = mysql_query($sql);
	echo $rs? true:false;

	include 'endConnect.php';
?>