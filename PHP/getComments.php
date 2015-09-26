<?php 
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\dateClass.php';

	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION['user']);
		$userData = $user->getData();
	}
	$date = new Date();
	
	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	$xml .= '<comments>';

	$autorName = '(select concat(nome, " ", sobrenome) from usuarios where email = a.autor)';
	$aproves = '(select count(*) from commentsVotes where isPositive and commentId = a.id)';
	$desaproves = '(select count(*) from commentsVotes where not isPositive and commentId = a.id)';
	$vote = '(select isPositive from commentsVotes where usuario = "'.$userData['email'].'" and commentId = a.id)';
	
	$sql = 'select a.*, '.$autorName.' as autorName, '.$aproves.' as aproves, '.$desaproves.' as desaproves, '.$vote.' as vote
			from comentarios as a
			where materia = '.$_POST['matId'].' and replyOf = 0 order by `date` desc';
	$rs = mysql_query($sql);
	while ($row = mysql_fetch_array($rs)){
		$sql = 'select a.*, '.$autorName.' as autorName, '.$aproves.' as aproves, '.$desaproves.' as desaproves, '.$vote.' as vote
				from comentarios as a
				where replyOf = '.$row['id'].' order by `date` desc';;
		$replyResult = mysql_query($sql);
		$replies = '<replies>';
		while($reply = mysql_fetch_array($replyResult)){
			$replies .= '<reply id="'.$reply['id'].'">';

			$already = !is_null($reply['vote']);
			$date->setSqlDate($reply['date']);

			$replies .= '<reply_author email="'.$reply['autor'].'">'.$reply['autorName'].'</reply_author>';	
			$replies .= '<reply_content>'.$reply['conteudo'].'</reply_content>';
			$replies .= '<reply_date>'.$date->getDisplayableDate().'</reply_date>';
			$replies .= '<votes><reply_positive already="'.($already?$reply['vote']:0).'">'.$reply['aproves'].'</reply_positive>';
			$replies .= '<reply_negative already="'.($already?($reply['vote']-1)*-1:0).'">'.$reply['desaproves'].'</reply_negative></votes>';
			$replies .= '</reply>';
		}
		$replies .= '</replies>';

		$xml .= '<comment id="'.$row['id'].'">';
		
		$already = !is_null($row['vote']);
		$date->setSqlDate($row['date']);

		$xml .= '<author email="'.$row['autor'].'">'.$row['autorName'].'</author>';	
		$xml .= '<content>'.$row['conteudo'].'</content>';
		$xml .= '<date>'.$date->getDisplayableDate().'</date>';
		$xml .= '<votes><positive already="'.($already?$row['vote']:0).'">'.$row['aproves'].'</positive>';
		$xml .= '<negative already="'.($already?($row['vote']-1)*-1:0).'">'.$row['desaproves'].'</negative></votes>';
		$xml .= $replies;
		$xml .= '</comment>';
	}
	$xml .= '</comments>';
	header("Content-type: xml: encoding=UTF-8");
	echo $rs?$xml:mysql_error();
?>