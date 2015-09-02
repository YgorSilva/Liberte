<?php
	include 'connect.php';
	include 'C:/xampp/htdocs/Liberte/PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	if(isset($_GET['getLastCover'])){
		if(isset($_SESSION['cover'])) echo $_SESSION['cover'];
		else echo false;
		unset($_SESSION['cover']);
	} 
		
	else{
		if($_FILES["capa"]['error']==0){
			$ext = substr($_FILES["capa"]["name"], strpos(strrev($_FILES["capa"]["name"]),".")*-1);
			$capa = md5(time().$_FILES["capa"]["name"]).".".$ext;
			move_uploaded_file($_FILES["capa"]["tmp_name"], "C:/xampp/htdocs/Liberte/images/".$capa);
		}
		else $capa = 'capa_default.png';
		$_SESSION['cover'] = 'http://localhost/Liberte/images/'.$capa;
	}
?>