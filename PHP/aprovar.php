<?php 
	include 'connect.php';

	$sql = 'insert aprovarDesaprovar values ("'.$_GET["matId"].'","'.$_SESSION['user'].'","'.$_GET['type'].'")';
	$rs = mysql_query($sql);
	if($rs){
		$sql ='select count(*) from aprovarDesaprovar where materia = "'.$_GET['matId'].'"';
		$rs = mysql_query($sql)[0];
		echo $rs;
	}
	else{
		echo 0;
	}
?>