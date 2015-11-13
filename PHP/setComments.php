<?php 
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	include '../PHPClasses/dateClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$sql = 'insert comentarios (autor, conteudo, materia, replyOf) 
			values('.$userData['id'].', "'.$_POST['content'].'", '.$_POST['id'].', '.$_POST['replyOf'].')';
	$rs = mysql_query($sql);

	if($rs){
		$id = mysql_insert_id();
		$sql = 'select * from comentarios where id='.$id;
		$row = mysql_fetch_array(mysql_query($sql));
		$date = new Date();
		$date->setSqlDate($row['date']);

		$xml = '<comment id="'.$id.'">';
		$xml .= '<author id="'.$row['autor'].'">'.$userData['nome'].' '.$userData['sobrenome'].'</author>';	
		$xml .= '<content>'.$row['conteudo'].'</content>';
		$xml .= '<date>'.$date->getDisplayableDate().'</date>';
		$xml .= '<votes><positive already="0">0</positive>';
		$xml .= '<negative already="0">0</negative></votes>';
		$xml .= '</comment>';
		echo $xml;
	}
	else echo false;

	include '../PHP/endConnect.php';
?>