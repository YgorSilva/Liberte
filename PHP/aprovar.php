<?php 
	include 'connect.php';

	if(isset($_SESSION['user'])){
		$sql = 'insert aprovarDesaprovar values ("'.$_GET["matId"].'","'.$_SESSION['user'].'","'.$_GET['type'].'")';
		$rs = mysql_query($sql);
		echo $rs? true:false;
	}
	else{
		echo false;
	}

	include 'endConnect.php';
?>