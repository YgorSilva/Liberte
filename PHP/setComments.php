<?php 
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$sql = 'insert comentarios (autor, conteudo, materia, replyOf) 
			values("'.$userData['email'].'", "'.$_POST['content'].'", '.$_POST['id'].', '.$_POST['replyOf'].')';
	$rs = mysql_query($sql);

	if($rs){
		$id = mysql_insert_id();
		$sql = 'select * from comentarios where id='.$id;
		$row = mysql_fetch_array(mysql_query($sql));

		$xml = '<comment id="'.$id.'">';
		$xml .= '<author email="'.$row['autor'].'">'.$userData['nome'].' '.$userData['sobrenome'].'</author>';	
		$xml .= '<content>'.$row['conteudo'].'</content>';
		$xml .= '<date>'.$row['date'].'</date>';
		$xml .= '<votes><positive already="0">0</positive>';
		$xml .= '<negative already="0">0</negative></votes>';
		$xml .= '</comment>';
		echo $xml;
	}
	else echo false;

	include 'endConnect.php';
?>