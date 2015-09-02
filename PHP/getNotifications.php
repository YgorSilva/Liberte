<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<notifications>';
	
	$materias = '(select idMateria from materias where autor = "'.$userData['email'].'")';
	$comentarios = '(select id from comentarios where autor ="'.$userData['email'].'")';
	$commentAutorName = '(select concat(nome, " ", sobrenome) from usuarios where email = a.autor)';
	$voteAutorName = '(select concat(nome, " ", sobrenome) from usuarios where email = a.usuario)';
	$titulo = '(select titulo from materias where idMateria = a.materia)';
	$replyOf = '(select conteudo from comentarios where id = a.replyOf)';
	$voteOf = '(select conteudo from comentarios where id = a.commentId)';
	$subscriber = '(select concat(nome, " ", sobrenome) from usuarios where email = a.assinante)';
	$materia = '(select materia from denuncias where id = a.denuncia)';
	$tituloDenuncia = '(select titulo from materias where idMateria = '.$materia.')';

	$sql = 'select * from
			(select "comment" as `type`, id, conteudo, autor, '.$commentAutorName.' as autorName, materia, '.$titulo.' as titulo, `date`, visualized 
				from comentarios as a where materia in '.$materias.' and autor <> "'.$userData['email'].'" and replyOf = 0) 
			as a union
			(select "vote" as `type`, isPositivo, null, usuario, '.$voteAutorName.', materia, '.$titulo.', `date`, visualized 
				from aprovarDesaprovar as a where materia in '.$materias.' and usuario <> "'.$userData['email'].'")
			union
			(select "subscription" as `type`, null, null, assinante, '.$subscriber.', null, null, `date`, visualized 
				from assinaturas as a where assinado = "'.$userData['email'].'")
			union
			(select "reply" as `type`, replyOf, conteudo, autor, '.$commentAutorName.', materia, '.$replyOf.', `date`, visualized 
				from comentarios as a where replyOf in '.$comentarios.' and autor <> "'.$userData['email'].'")
			union
			(select "commentVote" as `type`, isPositive, null, usuario, '.$voteAutorName.', commentId , '.$voteOf.', `date`, visualized 
				from commentsVotes as a where commentId in '.$comentarios.' and usuario <> "'.$userData['email'].'")
			union
			(select "denuncia" as `type`, denuncia, null, usuario, null, '.$materia.', '.$tituloDenuncia.', `date`, visualized 
				from juriSelecionado as a where usuario = "'.$userData['email'].'")
			order by `date` desc limit 5;';
	$rs = mysql_query($sql);
	echo mysql_error();
	while($row = mysql_fetch_array($rs)){
		if($row['type'] == 'vote'){
			$type = $row['id']?'aprove':'desaprove';
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="'.$type.'" visualized="'.$visualized.'">';
			$xml .= '<sender email="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'comment'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="comment" visualized="'.$visualized.'">';
			$xml .= '<sender email="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<content>'.$row['conteudo'].'</content>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'subscription'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="subscription" visualized="'.$visualized.'">';
			$xml .= '<subscriber email="'.$row['autor'].'">'.$row['autorName'].'</subscriber>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'reply'){
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="reply" visualized="'.$visualized.'">';
			$xml .= '<sender email="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<comment matId="'.$row['materia'].'">'.$row['titulo'].'</comment>';
			$xml .= '<content>'.$row['conteudo'].'</content>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'commentVote'){	
			$type = $row['id']?'commentAprove':'commentDesaprove';
			$visualized = $row['visualized'] ? 1 : 0;
			
			$xml .= '<notification type="'.$type.'" visualized="'.$visualized.'">';
			$xml .= '<sender email="'.$row['autor'].'">'.$row['autorName'].'</sender>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
		else if($row['type'] == 'denuncia'){
			$visualized = $row['visualized']? 1 : 0;

			$xml .= '<notification type="denuncia" visualized="'.$visualized.'">';
			$xml .= '<denuncia>'.$row['id'].'</denuncia>';
			$xml .= '<materia id="'.$row['materia'].'">'.$row['titulo'].'</materia>';
			$xml .= '<date>'.$row['date'].'</date>';
			$xml .= '</notification>';
		}
	}

	$xml .= '</notifications>';
	echo $xml;

	$sql = 'update aprovarDesaprovar set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update comentarios set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update assinaturas set visualized = 1 where assinado = "'.$userData['email'].'"';
	mysql_query($sql);
	$sql = 'update commentsVotes set visualized = 1 where commentId in '.$comentarios;
	mysql_query($sql);
	$sql = 'update juriSelecionado set visualized = 1 where usuario = "'.$userData['email'].'"';
	mysql_query($sql);

	header("Content-type: xml: encoding=UTF-8");
	include 'endConnect.php';
?>