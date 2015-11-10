<?php
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();

	$conteudo = $_POST['conteudo'];
	for($i = 0; $i < strlen($conteudo); $i++){
		if($conteudo[$i] == "'" || $conteudo[$i] == '"'){
			$str1 = substr($conteudo, 0, $i);
			$str2 = substr($conteudo, $i+1, strlen($conteudo)-$i);
			$illegal = '\\"';
			$conteudo = $str1.$illegal.$str2;
			$i++;
		}
	}

	$isRascunho = $_GET['r']?1:0;
	$link = $_GET['r']?'rascunho.php':'materia.php';

	if($_GET['u']){
		$id = $_GET['id'];
		$sql = 'update materias set capa = "'.$_POST['cover'].'", titulo = "'.$_POST['titulo'].'", subtitulo = "'.$_POST['subtitulo'].'", 
		conteudo = "'.$conteudo.'", isRascunho = '.$isRascunho.' where idMateria = '.$id;
		
		foreach($_POST['tagInput'] as $tag){
			$tags[] = 'update tags set tag = "'.$tag.'" where materia = .'.$id;
		}
		$rs = mysql_query($sql);
	}
	else{
		$sql = 'insert materias (autor, capa, titulo, subtitulo, conteudo, isRascunho)'.
		' values('.$userData['id'].',"'.$_POST['cover'].'","'.$_POST['titulo'].'","'.$_POST['subtitulo'].'","'.$conteudo.'",'.$isRascunho.')';
		
		$rs = mysql_query($sql);
		$id = mysql_insert_id();
		foreach($_POST['tagInput'] as $tag){
			echo $tag;
			$tags[] = 'insert tags values("'.$tag.'", '.$id.')';
		}
	}
	foreach($tags as $tag){
		echo $tag;
		mysql_query($tag);
	}
	
	include 'endConnect.php';
?>