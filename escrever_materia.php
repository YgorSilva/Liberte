<html>
	<head>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/nova-materia.css"/>
	</head>
	<body>
		<?php include 'template/user_identify.php'; ?>
		<div id="inner-content">
			<form id="materia-form" method="POST" action="novamateria.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
				Capa: <input type="file" name="capa"/>
			<div id="elmt-content">
				<div class="materia titulo" id="titulo" onclick="editH(this);" already='false'>Nova matéria</div>
				<div class="materia subtitulo" id="subtitulo" onclick="editH(this);" already='false'>Sub-titulo</div>
				<textarea id="conteudo" rows="20" cols="20"></textarea>
			</div>
			<center>
				<input type="button" onclick='enviar();' value="Enviar matéria"/>
			</center>
			</form>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/materia.js" type="text/javascript"></script>
		<script src="tinymce\js\tinymce\tinymce.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>