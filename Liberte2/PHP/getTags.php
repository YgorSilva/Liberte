<?php 
	include '../PHP/connect.php';
	include '../PHPClasses/userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();
	
	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<tags>';

	$tags = 'where';
	foreach ($_POST['tags'] as $i => $tag) {
		$tags .= ($i>0?' or':'').' tag = "'.$tag.'"';
	}

	$assinados = '(select assinado from assinaturas where assinante = '.$userData['id'].')';
	$publicacoes = '(select count(*) from tags where tag = a.tag) as publicacoes';
	$assinantes = '(select count(*) from tag_assinatura where tag = a.tag) as assinantes';
	$assinantesAss = '(select count(*) from tag_assinatura 
					where tag = a.tag and usuario in '.$assinados.') as assinantesAss';
	$followed = '(select count(*) from tag_assinatura 
				where tag = a.tag and usuario = '.$userData['id'].') as followed';
	$sql = 'select a.tag, '.$publicacoes.', '.$assinantes.', '.$assinantesAss.', '.$followed.'
			from tags as a '.$tags.' limit '.sizeof($_POST['tags']);
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$xml .= '<tag followed="'.$row['followed'].'">';
		$xml .= '<text>'.$row['tag'].'</text>';
		$xml .= '<publicacoes>'.$row['publicacoes'].'</publicacoes>';
		$xml .= '<assinantes>'.$row['assinantes'].'</assinantes>';
		$xml .= '<assinantesAss>'.$row['assinantesAss'].'</assinantesAss>';
		$xml .= '</tag>';
	}
	$xml .= '</tags>';
	header("Content-type: xml: encoding=UTF-8");
	echo $rs?$xml:mysql_error();
?>
