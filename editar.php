<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/escrever.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			include 'PHPClasses/userClass.php';
			$user = unserialize($_SESSION['user']);
			$userData = $user->getData(); 
			include 'template/userHeader.php'; 
			$id = $_GET['matId'];

			$sql = 'select * from materias where idMateria = "'.$id.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs);
			$capa = $reg['capa'];
			$titulo = $reg['titulo'];
			$subtitulo = $reg['subtitulo'];
			$conteudo = $reg['conteudo'];
			$isRascunho = $reg['isRascunho'];	
		?>
		<div id="inner-content">
			<form id="materia-form" method="POST" enctype="multipart/form-data">
				<center><img src="images/<?=$capa?>" style="width: 530px; height: 300px;"/></center>
				Mudar capa: <input type="file" name="capa"/>
			<div id="elmt-content">
				<div class="materia titulo" style="text-align: center;" id="titulo" onclick="editH(this);" already='false'><?=$titulo?></div>
				<div class="materia subtitulo" style="text-align: center;" id="subtitulo" onclick="editH(this);" already='false'><?=$subtitulo?></div>
				<textarea id="conteudo" name="conteudo" rows="20" cols="20"><?=$conteudo?></textarea>
			</div>
			<center>
				<input type="button" onclick='enviar(0, 1, <?=$id?>);' value="Enviar matéria"/>
				<?=$isRascunho?'<input type="button" onclick="enviar(1, 1, <?=$id?>);" value="Salvar rascunho"/>':''?>
			</center>
			</form>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/escrever.js" type="text/javascript"></script>
		<script src="tinymce\js\tinymce\tinymce.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>