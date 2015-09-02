<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$assinados = '(select assinado from assinaturas where assinante = "'.$userData['email'].'")';
	$assinadosBS = '(select assinado from assinaturas where assinante in '.$assinados.')';
	$aproves = '(select count(*) from aprovarDesaprovar where isPositivo and materia = a.idMateria)';
	$aprovesBS = '((select count(*) from aprovarDesaprovar where isPositivo and materia = a.idMateria and usuario in ('.$assinados.'))*4)';
	//$recomendacoes = '(select ((count(*)*60)/count(*)) from recomendacoes where materia = a.idMateria and usuario in('.$assinados.'))';
	$comments = '((select count(*) from comentarios)*3)';
	$commentsBS = '((select count(*) from comentarios where autor in '.$assinados.')*12)';
	$datediff = '((select hour(timediff(now(), a.`date`)))*(-10))';
	$score = '('.$aproves.'+(IF((select a.autor in '.$assinados.'), 240, 0)+'.$aprovesBS.'+'.$comments.'+'.$commentsBS.'
		+'.$datediff.'))';
	$authorName = '(select concat(nome, " ", sobrenome) from usuarios where email = a.autor) as authorName';
	$aprovacoes = '(select count(*) from aprovarDesaprovar where materia = a.idMateria and isPositivo) as aprovacoes';
	$aprovou = 'IF((select count(*) from aprovarDesaprovar 
				where materia = a.idMateria and isPositivo and usuario = "'.$userData['email'].'"), 1, 0) as aprovou';
	$desaprovar = '(select count(*) from aprovarDesaprovar where materia = a.idMateria and not isPositivo) as desaprovacoes';
	$desaprovou = 'IF((select count(*) from aprovarDesaprovar 
				where materia = a.idMateria and not isPositivo and usuario = "'.$userData['email'].'"), 1, 0) as desaprovou';
	$sql = 'select a.*, '.$score.' as score, '.$authorName.', '.$aproves.' as aprovacoes, '.$aprovou.', '.$desaprovar.', '.$desaprovou.' 
			from materias as a order by score desc, idMateria desc';
	$rs = mysql_query($sql);
	
	if($rs){
		$xml = '<?xml version="1.0" encoding="utf-8"?>';
		$xml .= '<posts>';

		while($row = mysql_fetch_array($rs)){
			$xml .= '<post id="'.$row['idMateria'].'">';
			$xml .= '<title>'.$row['titulo'].'</title>';
			$xml .= '<subtitle>'.$row['subtitulo'].'</subtitle>';
			$xml .= '<cover>'.$row['capa'].'</cover>';
			$xml .= '<author email="'.$row['autor'].'">'.$row['authorName'].'</author>';
			$xml .= '<aprovar already="'.$row['aprovou'].'">'.$row['aprovacoes'].'</aprovar>';
			$xml .= '<desaprovar already="'.$row['desaprovou'].'">'.$row['desaprovacoes'].'</desaprovar>';
			$xml .= '</post>';
		}
		$xml .= '</posts>';
		header("Content-type: xml: encoding=UTF-8");
		echo $xml;
	}
	else echo mysql_error();
?>