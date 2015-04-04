<?php 
	include 'connect.php';

	if($_GET['function'] == 'insert'){
		if(isset($_GET['user'])){
			$sql = 'insert aprovarDesaprovar values ("'.$_GET["matId"].'","'.$_GET['user'].'","'.$_GET['type'].'")';
			$rs = mysql_query($sql);
			echo $rs? true:false;
		}
		else{
			echo false;
		}
	}
	else if($_GET['function'] == 'undo'){
		if(isset($_GET['user'])){
			$sql = 'delete from aprovarDesaprovar where materia = "'.$_GET['matId'].'" and usuario = "'.$_GET['user'].'"';
			$rs = mysql_query($sql);
			echo $rs? true:false;
		}
		else{
			echo false;
		}	
	}

	include 'endConnect.php';
?>