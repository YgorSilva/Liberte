<?php 
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$sql = 'insert denuncias(autor, materia) values('.$userData['id'].', '.$_POST['matId'].')';
	$rs = mysql_query($sql);

	if($rs){
		$denuncia = mysql_insert_id();
		
		$autor = '(select autor from materias where idMateria = '.$_POST['matId'].')';
		$juriSelec = '(select usuario from juriSelecionado)';
		$sql = 'select userid from usuarios where userid <> '.$userData['id'].' and userid <> '.$autor.' and not userid in '.
		$juriSelec.' limit 10';
		$rs = mysql_query($sql);
		
		$values = '('.$denuncia.', "'.mysql_fetch_array($rs)[0].'")';
		while($row = mysql_fetch_array($rs)){
			$values .= ', ('.$denuncia.', "'.$row[0].'")'; 
		}
		
		$sql = 'insert juriSelecionado(denuncia, usuario) values'.$values;
		$rs = mysql_query($sql);
		echo true;
	}
	else echo false;
?>