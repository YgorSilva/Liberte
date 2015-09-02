<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userCLass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if($_POST['answer']){
		$sql = 'insert juri (denuncia, usuario) values('.$_POST['denuncia'].', "'.$userData['email'].'")';
		$rs = mysql_query($sql);
		if($rs){
			$sql = 'delete from juriSelecionado where usuario = "'.$userData['email'].'"';
			$rs = mysql_query($sql);
			echo true;
		}
		else echo false;
	}
	else{
		$sql = 'insert juriNegado values('.$_POST['denuncia'].', "'.$userData['email'].'")';
		$rs = mysql_query($sql);
		if($rs){
			$juris = '(select * from
						(select usuario from juriSelecionado where denuncia = '.$_POST['denuncia'].') as a
						union (select usuario from juriNegado where denuncia = '.$_POST['denuncia'].')
						union (select usuario from juri where denuncia = '.$_POST['denuncia'].'))';
			$autor = '(select autor from materias where idMateria = '.$_POST['matId'].')';
			$denunciador = '(select autor from denuncias where id = '.$_POST['denuncia'].')';
			$email = '(select email from usuarios where email <> "'.$userData['email'].'" and email <> '.$autor.' and email <> '.$denunciador.' 
			and email not in '.$juris.' limit 1)';
			$email = mysql_fetch_array(mysql_query($email))[0];
			echo $email.'</br>';
			$sql = 'insert juriSelecionado(denuncia, usuario) values('.$_POST['denuncia'].', "'.$email.'")';
			$rs = mysql_query($sql);
			if($rs){
				echo $email;
				echo mysql_error();
				$sql = 'delete from juriSelecionado where usuario = "'.$userData['email'].'"';
				$rs = mysql_query($sql);
				if($rs) echo true;
			} 
			else echo mysql_error();
		}
		else echo false;
	}
?>