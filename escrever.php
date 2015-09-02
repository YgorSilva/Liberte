<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/escrever.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
		<script src="js/jquery.form-3.46.0.js" type="text/javascript"></script>
	</head>
	<body>
		<script src="js/escrever.js" type="text/javascript"></script>
		<?php 
			include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';
			$user = unserialize($_SESSION['user']);
			$userData = $user->getData();
			
			include 'template/userHeader.php';
		?>
		<div id="inner-content">
			<form id="materia-form" method="POST" enctype="multipart/form-data">
				<img onclick='changeCover()' class='materia capa' src='http://localhost/Liberte/images/capa_default.png' width='50%'/>
				<input class='fileBtn' type='file' name='capa'/>
			</form>
				<div id="elmt-content">
					<div class="materia titulo" style="text-align: center;" id="titulo" onclick="editH(this);" already='false'>Nova matéria</div>
					<div class="materia subtitulo" style="text-align: center;" id="subtitulo" onclick="editH(this);" already='false'>Sub-titulo</div>
					<textarea id="conteudo" name="conteudo" rows="20" cols="20"></textarea>
				</div>
				<center>
					<input type="button" onclick='enviar();' value="Enviar matéria"/>
					<input type="button" onclick='enviar(1);' value="Salvar matéria"/>
				</center>
		</div>
		<script src="tinymce\js\tinymce\tinymce.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'});</script>
		<?php include 'PHP/endConnect.php'; ?>
	</body>
</html>