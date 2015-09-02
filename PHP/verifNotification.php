<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$materias = '(select idMateria from materias where autor = "'.$userData['email'].'")';
	$comentarios = '(select id from comentarios where autor = "'.$userData['email'].'")';
	$sql = 'select a.x + b.x as res
				from 
				(select count(*) as x from aprovarDesaprovar where not visualized and materia in '.$materias.' and usuario <> "'.$userData['email'].'") a
				inner join 
					(select x.x + y.x as x 
					from 
					(select count(*) as x from assinaturas where not visualized and assinado = "'.$userData['email'].'") x
					inner join 
						(select x.x + y.x as x
						from
						(select count(*) as x from comentarios where not visualized and (materia in '.$materias.' or replyOf in '.$comentarios.') and autor <> "'.$userData['email'].'") x
						inner join
							(select x.x + y.x as x
							from
							(select count(*) as x from juriSelecionado where not visualized and usuario = "'.$userData['email'].'") x
							inner join
							(select count(*) as x from commentsVotes where not visualized and commentId in '.$comentarios.' and usuario <> "'.$userData['email'].'") y) y) y) b';
	$rs = mysql_query($sql);
	if($rs){	
		$res = mysql_fetch_array($rs)[0];
		echo $res? $res : false;
	}
	else echo mysql_error();
?>