<?php
	include '../PHP/connect.php';

	if(isset($_GET['getLastImg'])){
		if(isset($_SESSION['perfil'])){
			echo $_SESSION['perfil'];
			unset($_SESSION['perfil']);
		} 
		else echo false;
	} 
	else{
		if($_FILES["perfilImg"]['error']==0){
			$ext = substr($_FILES["perfilImg"]["name"], strpos(strrev($_FILES["perfilImg"]["name"]),".")*-1);
			$perfilImg = md5(time().$_FILES["perfilImg"]["name"]).".".$ext;
			move_uploaded_file($_FILES["perfilImg"]["tmp_name"], "../images/".$perfilImg);
		}
		else $perfilImg = 'perfil_img_default.png';
		$_SESSION['perfil'] = '../images/'.$perfilImg;
	}
?>