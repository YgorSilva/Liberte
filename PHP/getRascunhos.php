<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<rascunhos>';
	
	$sql = 'select idMateria from materias where autor = "'.$userData['email'].'" and isRascunho = 1';
	$rs = mysql_query($sql);
	
	while($row = mysql_fetch_array($rs)){		
		$xml .= '<rascunho>';
		$xml .= '<capa>'.$row['capa'].'</capa>';
		$xml .= '<titulo>'.$row['titulo'].'</titulo>';
		$xml .= '<subtitulo>'.$row['subtitulo'].'</subtitulo>';
		$xml .= '</rascunho>';
	}

	$xml .= '</rascunhos>'
	header("Content-type: xml: encoding=UTF-8");
	include 'endConnect.php';
?>