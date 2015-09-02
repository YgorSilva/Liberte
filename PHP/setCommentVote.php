<?php 
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(!$_POST['undo']){
		$sql = 'insert commentsVotes (commentId, usuario, isPositive) 
			values('.$_POST['commentId'].' ,"'.$userData['email'].'", '.$_POST['isPositive'].')';
	}
	else $sql = 'delete from commentsVotes where commentId = '.$_POST['commentId'].' and usuario = "'.$userData['email'].'"';
	$rs = mysql_query($sql);

	echo $rs?true:false;
	include 'endConnect.php';
?>