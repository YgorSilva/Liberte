<html>
	<head>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/materia.css"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
	</head>
	<body>
		<?php include 'template/user_identify.php'; ?>
		<?php
			$sql = 'select * from materia where id = '.$_GET['mat_id'];
			$rs = mysql_query($sql, $con);
			$reg = mysql_fetch_array($rs);
			$id = $reg['id'];
			$capa = $reg['capa'];
			$titulo = $reg['titulo'];
			$subtitulo = $reg['subtitulo'];
			$autor = $reg['autor'];
			$sql = 'select nome, sobrenome from usuario where id = '.$autor;
			$rs = mysql_query($sql, $con);
			$reg = mysql_fetch_array($rs);
			$autor_nome = $reg['nome'];
			$autor_sobrenome = $reg['sobrenome'];
		?>
		<div id="inner-content">
			<div id="materia-content">
				<img src="images/<?php echo $capa; ?>" style="width: 530px; height: 300px;"/>
				<h1><?php echo $titulo ?></h1>
				<h3><?php echo $subtitulo ?></h3>
				<?php
					$sql = 'select * from paragrafo where materia = "'.$id.'" order by id';
					$rs = mysql_query($sql, $con);
					for ($i=0; $i < mysql_num_rows($rs); $i++) { 
						$reg = mysql_fetch_array($rs);
						echo $reg['conteudo'];					
					}
				?>
				<h6> por <?php echo $autor_nome.' '.$autor_sobrenome; ?></h6>
			</div>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/materia.js" type="text/javascript"></script>
	</body>
</html>