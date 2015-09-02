<?php
	include 'connect.php';
	include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';

	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();


	if(isset($_GET['u'])){
		$id = $_GET['id'];
		$sql = 'select capa from materias where idMateria = '.$id; 
		$capaDefault = mysql_fetch_array(mysql_query($sql))[0];
	}
	else $capaDefault = 'capa_default.png';

	if($_FILES["capa"]['error']==0){
		$ext = substr($_FILES["capa"]["name"], strpos(strrev($_FILES["capa"]["name"]),".")*-1);
		$capa = md5(time().$_FILES["capa"]["name"]).".".$ext;
		move_uploaded_file($_FILES["capa"]["tmp_name"], "C:/xampp/htdocs/Liberte/images/".$capa);
	}
	else $capa = $capaDefault;

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
		$sql = 'update materias set capa = "'.$capa.'", titulo = "'.$_POST['titulo'].'", subtitulo = "'.$_POST['subtitulo'].'", 
		conteudo = "'.$conteudo.'", isRascunho = '.$isRascunho.' where idMateria = '.$id;
	}
	else{
		$sql = 'insert materias (autor, capa, titulo, subtitulo, conteudo, isRascunho)'.
		' values("'.$userData['email'].'","'.$capa.'","'.$_POST['titulo'].'","'.$_POST['subtitulo'].'","'.$conteudo.'",'.$isRascunho.')';
	
		if($capaDefault != "capa_default.png" and $capa != $capaDefault){
			unlink("images/".$capaDefault);
		}
	}
	$rs = mysql_query($sql);
	$id = $id?$id:mysql_insert_id();
	
	if($rs) echo '<meta http-equiv="refresh" content="0;URL=/Liberte/'.$link.'?matId='.$id.'">';
	else echo '<meta http-equiv="refresh" content="0;URL=escrever_materia.php';
	include 'endConnect.php';
?>