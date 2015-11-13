<?php
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$materias = '(select idMateria from materias where autor = '.$userData['id'].')';
	$comentarios = '(select id from comentarios where autor = '.$userData['id'].')';
	$sql = 'select a.x + b.x as res
				from 
				(select count(*) as x from aprovarDesaprovar where not visualized and materia in '.$materias.' and usuario <> '.$userData['id'].') a
				inner join 
					(select x.x + y.x as x 
					from 
					(select count(*) as x from assinaturas where not visualized and assinado = '.$userData['id'].') x
					inner join 
						(select x.x + y.x as x
						from
						(select count(*) as x from comentarios where not visualized and (materia in '.$materias.' or replyOf in '.$comentarios.') and autor <> '.$userData['id'].') x
						inner join
							(select x.x + y.x as x
							from
							(select count(*) as x from juriSelecionado where not visualized and usuario = '.$userData['id'].') x
							inner join
							(select count(*) as x from commentsVotes where not visualized and commentId in '.$comentarios.' and usuario <> '.$userData['id'].') y) y) y) b';
	$rs = mysql_query($sql);
	if($rs){	
		$res = mysql_fetch_array($rs)[0];
		echo $res? $res : false;
	}
	else echo mysql_error();
?>