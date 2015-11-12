<?php
	include '/PHP/connect.php';
	include '/PHPClasses/userClass.php';
	include '/PHPClasses/dateClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();
	$date = new Date();

	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<notifications>';
	
	$materias = '(select idMateria from materias where autor = '.$userData['id'].')';
	$comentarios = '(select id from comentarios where autor ='.$userData['id'].')';
	$commentAutorName = '(select concat(nome, " ", sobrenome) from usuarios where userid = a.autor)';
	$voteAutorName = '(select concat(nome, " ", sobrenome) from usuarios where userid = a.usuario)';
	$titulo = '(select titulo from materias where idMateria = a.materia)';
	$replyOf = '(select conteudo from comentarios where id = a.replyOf)';
	$voteOf = '(select conteudo from comentarios where id = a.commentId)';
	$subscriber = '(select concat(nome, " ", sobrenome) from usuarios where userid = a.assinante)';
	$materia = '(select materia from denuncias where id = a.denuncia)';
	$tituloDenuncia = '(select titulo from materias where idMateria = '.$materia.')';

	$sql = 'select * from
			(select "comment" as `type`, id, conteudo, autor, '.$commentAutorName.' as autorName, materia, '.$titulo.' as titulo, `date`, visualized 
				from comentarios as a where materia in '.$materias.' and autor <> '.$userData['id'].' and replyOf = 0) 
			as a union
			(select "vote" as `type`, isPositivo, null, usuario, '.$voteAutorName.', materia, '.$titulo.', `date`, visualized 
				from aprovarDesaprovar as a where materia in '.$materias.' and usuario <> '.$userData['id'].')
			union
			(select "subscription" as `type`, null, null, assinante, '.$subscriber.', null, null, `date`, visualized 
				from assinaturas as a where assinado = '.$userData['id'].')
			union
			(select "reply" as `type`, replyOf, conteudo, autor, '.$commentAutorName.', materia, '.$replyOf.', `date`, visualized 
				from comentarios as a where replyOf in '.$comentarios.' and autor <> '.$userData['id'].')
			union
			(select "commentVote" as `type`, isPositive, null, usuario, '.$voteAutorName.', commentId , '.$voteOf.', `date`, visualized 
				from commentsVotes as a where commentId in '.$comentarios.' and usuario <> '.$userData['id'].')
			union
			(select "denuncia" as `type`, denuncia, null, usuario, null, '.$materia.', '.$tituloDenuncia.', `date`, visualized 
				from juriSelecionado as a where usuario = '.$userData['id'].')
			order by `date` desc limit 5;';
	$rs = mysql_query($sql);
	echo mysql_error();
	while($row = mysql_fetch_array($rs)){
		$date->setSqlDate($row['date']);
		if($row['type'] == 'vote'){
			$type = $row['id']?'aprove':'desaprove';
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="'.$type.'" visualized="'.$visualized.'">';
			$xml .= '<sender id="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'comment'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="comment" visualized="'.$visualized.'">';
			$xml .= '<sender id="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<content>'.$row['conteudo'].'</content>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'subscription'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="subscription" visualized="'.$visualized.'">';
			$xml .= '<subscriber id="'.$row['autor'].'">'.$row['autorName'].'</subscriber>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'reply'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="reply" visualized="'.$visualized.'">';
			$xml .= '<sender id="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<comment matId="'.$row['materia'].'">'.$row['titulo'].'</comment>';
			$xml .= '<content>'.$row['conteudo'].'</content>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'commentVote'){	
			$type = $row['id']?'commentAprove':'commentDesaprove';
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="'.$type.'" visualized="'.$visualized.'">';
			$xml .= '<sender id="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'denuncia'){
			$visualized = $row['visualized']? 1 : 0;

			$xml .= '<notification type="denuncia" visualized="'.$visualized.'">';
			$xml .= '<denuncia>'.$row['id'].'</denuncia>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$date->getDisplayableDate().'</date>';
			$xml .= '</notification>';
		}
	}

	$xml .= '</notifications>';
	echo $xml;

	/*$sql = 'update aprovarDesaprovar set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update comentarios set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update assinaturas set visualized = 1 where assinado = "'.$userData['email'].'"';
	mysql_query($sql);
	$sql = 'update commentsVotes set visualized = 1 where commentId in '.$comentarios;
	mysql_query($sql);
	$sql = 'update juriSelecionado set visualized = 1 where usuario = "'.$userData['email'].'"';
	mysql_query($sql);*/

	header("Content-type: xml: encoding=UTF-8");
	include 'endConnect.php';
?>