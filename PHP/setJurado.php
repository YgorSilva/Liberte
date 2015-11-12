<?php
	include '/PHP/connect.php';
	include '/PHPClasses/userCLass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if($_POST['answer']){
		$sql = 'insert juri (denuncia, usuario) values('.$_POST['denuncia'].', '.$userData['id'].')';
		$rs = mysql_query($sql);
		if($rs){
			$sql = 'delete from juriSelecionado where usuario = '.$userData['id'].'';
			$rs = mysql_query($sql);
			echo true;
		}
		else echo false;
	}
	else{
		$sql = 'insert juriNegado values('.$_POST['denuncia'].', '.$userData['id'].')';
		$rs = mysql_query($sql);
		if($rs){
			$juris = '(select * from
						(select usuario from juriSelecionado where denuncia = '.$_POST['denuncia'].') as a
						union (select usuario from juriNegado where denuncia = '.$_POST['denuncia'].')
						union (select usuario from juri where denuncia = '.$_POST['denuncia'].'))';
			$autor = '(select autor from materias where idMateria = '.$_POST['matId'].')';
			$denunciador = '(select autor from denuncias where id = '.$_POST['denuncia'].')';
			$userid = '(select email from usuarios where userid <> '.$userData['id'].' and userid <> '.$autor.' and userid <> '.$denunciador.' 
			and userid not in '.$juris.' limit 1)';
			$userid = mysql_fetch_array(mysql_query($userid))[0];
			$sql = 'insert juriSelecionado(denuncia, usuario) values('.$_POST['denuncia'].', '.$userid.')';
			$rs = mysql_query($sql);
			if($rs){
				$sql = 'delete from juriSelecionado where usuario = '.$userData['id'];
				$rs = mysql_query($sql);
				if($rs) echo true;
			} 
			else echo mysql_error();
		}
		else echo false;
	}
?>