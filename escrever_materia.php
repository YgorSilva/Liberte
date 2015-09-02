<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/nova-materia.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include 'template/userHeader.php'; ?>
		<div id="inner-content">
			<form id="materia-form" method="POST" enctype="multipart/form-data">
				Capa: <input type="file" name="capa"/>
			<div id="elmt-content">
				<div class="materia titulo" style="text-align: center;" id="titulo" onclick="editH(this);" already='false'>Nova matéria</div>
				<div class="materia subtitulo" style="text-align: center;" id="subtitulo" onclick="editH(this);" already='false'>Sub-titulo</div>
				<textarea id="conteudo" name="conteudo" rows="20" cols="20"></textarea>
			</div>
			<center>
				<input type="button" onclick='enviar();' value="Enviar matéria"/>
				<input type="button" onclick='enviar(1);' value="Salvar matéria"/>
			</center>
			</form>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/escrever_materia.js" type="text/javascript"></script>
		<script src="tinymce\js\tinymce\tinymce.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>