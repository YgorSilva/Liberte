<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<notifications>';
	
	$materias = '(select idMateria from materias where autor = "'.$userData['email'].'")';
	
	
	$sql = 'select * from aprovarDesaprovar where materia in ';
	
	$sql .= $materias.' and usuario <> "'.$userData['email'].'" order by `date` desc limit 5';
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$senderSql = 'select email, concat(nome, " ", sobrenome) from usuarios where email = "'.$row['usuario'].'"';
		$senderRs = mysql_query($senderSql);
		$sender = mysql_fetch_array($senderRs);

		$materiaSql = 'select idMateria, titulo from materias where idMateria = "'.$row['materia'].'"';
		$materiaRs = mysql_query($materiaSql);
		$materia = mysql_fetch_array($materiaRs);
		
		$type = $row['isPositivo']?'aprove':'desaprove';
		$visualized = $row['visualized'] ? 1 : 0;
		
		$xml .= '<notification type="'.$type.'" visualized="'.$visualized.'">';
		$xml .= '<sender email="'.$sender[0].'">'.$sender[1].'</sender>';
		$xml .= '<materia id="'.$materia[0].'">'.$materia[1].'</materia>';
		$xml .= '<date>'.$row['date'].'</date>';
		$xml .= '</notification>';
	}
	
	$sql = 'select * from comentarios where materia in '.$materias.' and autor <> "'.$userData['email'].'" order by `date` desc limit 5';
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$senderSql = 'select email, concat(nome, " ", sobrenome) from usuarios where email = "'.$row['autor'].'"';
		$senderRs = mysql_query($senderSql);
		$sender = mysql_fetch_array($senderRs);

		$materiaSql = 'select idMateria, titulo from materias where idMateria = "'.$row['materia'].'"';
		$materiaRs = mysql_query($materiaSql);
		$materia = mysql_fetch_array($materiaRs);
		
		$visualized = $row['visualized'] ? 1 : 0;
		
		$xml .= '<notification type="comment" visualized="'.$visualized.'">';
		$xml .= '<sender email="'.$sender[0].'">'.$sender[1].'</sender>';
		$xml .= '<materia id="'.$materia[0].'">'.$materia[1].'</materia>';
		$xml .= '<content>'.$row['conteudo'].'</content>';
		$xml .= '<date>'.$row['date'].'</date>';
		$xml .= '</notification>';
	}

	$sql = 'select * from assinaturas where assinado = "'.$userData['email'].'" order by `date` desc limit 5';
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$subscriberSql = 'select email, concat(nome, " ", sobrenome) from usuarios where email = "'.$row['assinante'].'"';
		$subscriberRs = mysql_query($subscriberSql);
		$subscriber = mysql_fetch_array($subscriberRs);

		$visualized = $row['visualized'] ? 1 : 0;
		
		$xml .= '<notification type="subscription" visualized="'.$visualized.'">';
		$xml .= '<subscriber email="'.$subscriber[0].'">'.$subscriber[1].'</subscriber>';
		$xml .= '<date>'.$row['date'].'</date>';
		$xml .= '</notification>';
	}

	$comentarios = '(select id from comentarios where autor ="'.$userData['email'].'")';
	$sql = 'select * from comentarios where replyOf in '.$comentarios.' and autor <> "'.$userData['email'].'" order by `date` desc limit 5';
	$rs = mysql_query($sql);
	while ($row = mysql_fetch_array($rs)){
		$senderSql = 'select email, concat(nome, " ", sobrenome) from usuarios where email = "'.$row['usuario'].'"';
		$senderRs = mysql_query($senderSql);
		$sender = mysql_fetch_array($senderRs);

		$visualized = $row['visualized'] ? 1 : 0;
		
		$xml .= '<notification type="reply" visualized="'.$visualized.'">';
		$xml .= '<sender email="'.$sender[0].'">'.$sender[1].'</sender>';
		$xml .= '<materia>'.$row['materia'].'</materia>';
		$xml .= '<content>'.$row['conteudo'].'</content>';
		$xml .= '<date>'.$row['date'].'</date>';
		$xml .= '</notification>';
	}

	$xml .= '</notifications>';
	echo $xml;

	$sql = 'update aprovarDesaprovar set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update comentarios set visualized = 1 where materia in '.$materias;
	mysql_query($sql);
	$sql = 'update assinaturas set visualized = 1 where assinado = "'.$userData['email'].'"';
	mysql_query($sql);

	header("Content-type: xml: encoding=UTF-8");
	include 'endConnect.php';
?>