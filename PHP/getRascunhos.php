<?php
	include '/PHP/connect.php';
	include '/PHPClasses/userClass.php';
	include '/PHPClasses/dateClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();
	$date = new Date();

	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<rascunhos>';
	
	$sql = 'select * from materias where autor = '.$userData['id'].' and isRascunho = 1';
	$rs = mysql_query($sql);
	
	while($row = mysql_fetch_array($rs)){
		$date->setSqlDate($row['date']);
		$xml .= '<rascunho id="'.$row['idMateria'].'">';
		$xml .= '<cover>'.$row['capa'].'</cover>';
		$xml .= '<title>'.$row['titulo'].'</title>';
		$xml .= '<subtitle>'.$row['subtitulo'].'</subtitle>';
		$xml .= '<date>'.$date->getDisplayableDate().'</date>';
		$xml .= '</rascunho>';
	}

	$xml .= '</rascunhos>';
	header("Content-type: xml: encoding=UTF-8");
	echo $xml;
	include 'endConnect.php';
?>