<?php
	include '../PHP/connect.php';
	
	if(isset($_GET['getLastCover'])){
		if(isset($_SESSION['cover'])){
			echo $_SESSION['cover'];
			unset($_SESSION['cover']);
		} 
		else echo false;
	} 
	else{
		if($_FILES["capa"]['error']==0){
			$ext = substr($_FILES["capa"]["name"], strpos(strrev($_FILES["capa"]["name"]),".")*-1);
			$capa = md5(time().$_FILES["capa"]["name"]).".".$ext;
			move_uploaded_file($_FILES["capa"]["tmp_name"], "/images/".$capa);
		}
		else $capa = 'capa_default.png';
		$_SESSION['cover'] = '/images/'.$capa;
	}
?>