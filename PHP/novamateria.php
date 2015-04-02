<?php
	include 'PHP/connect.php';
	include 'PHPClasses/userClass.php';

	$user = new User();
	$user->feedData($_SESSION['user']);
	$userData = $user->getData();

	if($_FILES["capa"]['error']==0){
		$ext = substr($_FILES["capa"]["name"], strpos(strrev($_FILES["capa"]["name"]),".")*-1);
		$capa = md5(time().$_FILES["capa"]["name"]).".".$ext;
		move_uploaded_file($_FILES["capa"]["tmp_name"], "images/".$capa);
	}
	else{
		$capa = 'capa_default.png';
	}

	$conteudo = $_POST['conteudo'];
	for($i = 0; $i < strlen($conteudo); $i++){
		if($conteudo[$i] == "'" || $conteudo[$i] == '"'){
			$str1 = substr($conteudo, 0, $i);
			$str2 = substr($conteudo, $i+1, strlen($conteudo)-$i);
			echo $str1.'</br>';
			echo $str2.'</br>';
			$illegal = '\\"';
			echo $illegal.'</br>';
			$conteudo = $str1.$illegal.$str2;
			echo $conteudo.'</br>';
			$i++;
		}
	}

	$sql = 'insert materias (autor, capa, titulo, subtitulo, conteudo)'.
	' values("'.$userData['email'].'","'.$capa.'","'.$_POST['titulo'].'","'.$_POST['subtitulo'].'","'.$conteudo.'")';
	$rs = mysql_query($sql);
	
	if($rs){
		$sql = 'select idMateria from materias where autor = "'.$userData['email'].'" order by idMateria desc';
		$rs = mysql_query($sql);
		$reg = mysql_fetch_array($rs);
		echo '<meta http-equiv="refresh" content="0;URL=materia.php?matId='.$reg['idMateria'].'">';
	}
	else echo mysql_error();
	echo '<textarea cols="60" rows="20">'.$conteudo.'</textarea>';
	include 'PHP/endConnect.php';
?>