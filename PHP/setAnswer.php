<?php
	include '/PHP/connect.php';
	include '/PHPClasses/userCLass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$sql = 'update juri set answer = '.$_POST['answer'].' where usuario = '.$userData['id'];
	$rs = mysql_query($sql);
	if($rs){
		$sql = 'select a.sim, b.nao from (select count(*) as sim from juri where resposta) a 
		inner join (select count(*) as nao from juri where resposta) b';
		$row = mysql_fetch_array(mysql_query($sql));
		if($row[0] + $row[1] == 10){
			if($row [0] > $row[1]) $sql = 'update denuncias set result = 1';
			else $sql = 'update denuncias set result = 0';
			$rs = mysql_query($sql);
		}
	}
?>