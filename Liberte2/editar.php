<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/escrever.css"/>
		<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			include 'template/userHeader.php'; 
			$id = $_GET['matId'];

			$sql = 'select * from materias where idMateria = '.$id;
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs);
			$capa = $reg['capa'];
			$titulo = $reg['titulo'];
			$subtitulo = $reg['subtitulo'];
			$conteudo = $reg['conteudo'];
			$isRascunho = $reg['isRascunho'];
			$sql = 'select tag from tags where materia = '.$id;
			$rs = mysql_query($sql);
			$i = 0;
			$tagInputs = [];
			while($tagName = mysql_fetch_array($rs)){
				$tagInputs[] = '<input type="text" class="materia tagInput done" name="tagInput['.$i.']" value="'.$tagName['tag'].'" placeholder="Adcione uma tag"/>';
				$i++;
			}

			include 'template/navBar.php'; 
			include 'template/actionBar.php'; 
		?>
		<div id="inner-content">
			<form id="cover-form" method="POST" enctype="multipart/form-data">
				<img onclick='changeCover()' class='materia capa' src='http://localhost/Liberte/images/<?=$capa?>' width='50%'/>
				<input class='fileBtn' type='file' name='capa'/>
			</form>
			<form id="materia-form" method="POST" enctype="multipart/form-data">
				<div id="elmt-content">
					<div class="materia titulo" style="text-align: center;" id="titulo" onclick="editH(this);" already='false'><?=$titulo?></div>
					<div class="materia subtitulo" style="text-align: center;" id="subtitulo" onclick="editH(this);" already='false'><?=$subtitulo?></div>
					<textarea id="conteudo" name="conteudo" rows="20" cols="20"><?=$conteudo?></textarea>
				</div>
				<center>
					<div id='tagInputDiv'>
						<?php
							foreach($tagInputs as $i => $input){
								echo $input;
							}
						?>
						<input type="button" class="tagControls" id="tagAdd" value="+"/>
					</div>
					<input type="button" onclick='enviar(0, 1, <?=$id?>);' value="Publicar"/>
					<?=$isRascunho?'<input type="button" onclick="enviar(1, 1, <?=$id?>);" value="Salvar como rascunho"/>':''?>
				</center>
			</form>
		</div>
		<script src="js/escrever.js" type="text/javascript"></script>
		<script src="tinymce\js\tinymce\tinymce.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>