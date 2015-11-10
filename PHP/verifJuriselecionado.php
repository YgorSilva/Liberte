<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userCLass.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/dateCLass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$sql = 'select * from juriselecionado';
	$rs = mysql_query($sql);

	while($row = mysql_fetch_array($rs)){
		$date = new Date($row['date']);
		if($date->getFieldDiff('hours') >= 72){
			$sql = 'insert juriNegado values('.$_POST['denuncia'].', '.$row['userid'].')';
			$rs = mysql_query($sql);
			if($rs){
				$juris = '(select * from
						(select usuario from juriSelecionado where denuncia = '.$_POST['denuncia'].') as a
						union (select usuario from juriNegado where denuncia = '.$_POST['denuncia'].')
						union (select usuario from juri where denuncia = '.$_POST['denuncia'].'))';
				$autor = '(select autor from materias where idMateria = '.$_POST['matId'].')';
				$denunciador = '(select autor from denuncias where id = '.$_POST['denuncia'].')';
				$userid = '(select userid from usuarios where userid <> '.$row['userid'].' and userid <> '.$autor.' and userid <> '.$denunciador.' 
				and userid not in '.$juris.' limit 1)';
				$userid = mysql_fetch_array(mysql_query($userid))[0];
				$sql = 'insert juriSelecionado(denuncia, usuario) values('.$_POST['denuncia'].', '.$userid.')';
				$rs = mysql_query($sql);
				if($rs){
					$sql = 'delete from juriSelecionado where usuario = "'.$row['userid'];
					$rs = mysql_query($sql);
					if($rs) echo true;
				} 
				else echo mysql_error();
			}
			else echo false;
		}
	}
?>