<?php
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';
	include '../PHPClasses/dateClass.php';
	$user = unserialize($_SESSION['user']);
	$date = new Date();
	$userData = $user->getData();

	$assinados = '(select assinado from assinaturas where assinante = '.$userData['id'].')';
	$assinadosBS = '(select assinado from assinaturas where assinante in '.$assinados.')';
	//$tags = '(select tag from assinatura_tag where usuario = "'.$userData['emil'].'")';
	//$matTags = '(select tag from tags where materia = a.idMateria)';
	$aproves = '(select count(*) from aprovardesaprovar where isPositivo and materia = a.idMateria)';
	$aprovesBS = '((select count(*) from aprovardesaprovar where isPositivo and materia = a.idMateria and usuario in ('.$assinados.'))*4)';
	$recomendacoes = '(select count(*) from recomendacoes where materia = a.idMateria)';
	$recomendacoesBS = '(select (count(*)*45) from recomendacoes where materia = a.idMateria and usuario in('.$assinados.'))';
	$recomendou = 'IF((select count(*) from recomendacoes 
				where materia = a.idMateria and usuario = '.$userData['id'].'), 1, 0) as recomendou';
	$comments = '((select count(*) from comentarios)*3)';
	$commentsBS = '((select count(*) from comentarios where autor in '.$assinados.')*12)';
	$datediff = '((select hour(timediff(now(), a.`date`)))*(-5))';
	$score = '('.$aproves.'+(IF((select a.autor in '.$assinados.'), 240, 0)+'.$aprovesBS.'
		+('.$recomendacoes.'*15)+'.$recomendacoesBS.'+'.$comments.'+'.$commentsBS.'+'.$datediff.'))';
	$authorName = '(select concat(nome, " ", sobrenome) from usuarios where userid = a.autor) as authorName';
	$authorImg = '(select imgPerfil from usuarios where userid = a.autor) as authorImg';
	$aprovou = 'IF((select count(*) from aprovardesaprovar 
				where materia = a.idMateria and isPositivo and usuario = '.$userData['id'].'), 1, 0) as aprovou';
	$desaprovar = '(select count(*) from aprovardesaprovar where materia = a.idMateria and not isPositivo) as desaprovacoes';
	$desaprovou = 'IF((select count(*) from aprovardesaprovar 
				where materia = a.idMateria and not isPositivo and usuario = '.$userData['id'].'), 1, 0) as desaprovou';
	$sql = 'select a.*, '.$score.' as score, '.$authorName.', '.$authorImg.', '.$aproves.' as aprovacoes, 
			'.$aprovou.', '.$desaprovar.', '.$desaprovou.', '.$recomendacoes.' as recomendacoes, '.$recomendou.' 
			from materias as a where not a.isRascunho order by score desc, idMateria desc';
	$rs = mysql_query($sql);
	
	if($rs){
		$xml = '<?xml version="1.0" encoding="utf-8"?>';
		$xml .= '<posts>';

		while($row = mysql_fetch_array($rs)){
			$date->setSqlDate($row['date']);
			$xml .= '<post id="'.$row['idMateria'].'">';
			$xml .= '<title>'.$row['titulo'].'</title>';
			$xml .= '<subtitle>'.$row['subtitulo'].'</subtitle>';
			$xml .= '<cover>'.$row['capa'].'</cover>';
			$xml .= '<author id="'.$row['autor'].'">'.$row['authorName'].'</author>';
			$xml .= '<authorImg>'.$row['authorImg'].'</authorImg>';
			$xml .= '<aprovar already="'.$row['aprovou'].'">'.$row['aprovacoes'].'</aprovar>';
			$xml .= '<desaprovar already="'.$row['desaprovou'].'">'.$row['desaprovacoes'].'</desaprovar>';
			$xml .= '<recomendar already="'.$row['recomendou'].'">'.$row['recomendacoes'].'</recomendar>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</post>';
		}
		$xml .= '</posts>';
		header("Content-type: xml: encoding=UTF-8");
		echo $xml;
	}
	else echo mysql_error();
?>