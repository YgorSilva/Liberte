<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/materia.css"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
	</head>
	<body>
		<?php 
			if(isset($_SESSION['user'])) include 'template/userHeader.php';
			else include 'template/header.php';

			$sql = 'select * from materias where idMateria = "'.$_GET['matId'].'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs);
			$id = $reg['idMateria'];
			$capa = $reg['capa'];
			$titulo = $reg['titulo'];
			$subtitulo = $reg['subtitulo'];
			$autor = $reg['autor'];
			$conteudo = $reg['conteudo'];
			
			$sql = 'select nome, sobrenome from usuarios where email = "'.$autor.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs);
			$autorNome = $reg['nome'];
			$autorSobrenome = $reg['sobrenome'];
		
			$sql = 'select count(*) from aprovarDesaprovar where isPositivo = true';
			$rs = mysql_query($sql);
			$aprovar = mysql_fetch_array($rs)[0];

			$sql = 'select count(*) from aprovarDesaprovar where isPositivo = false';
			$rs = mysql_query($sql);
			$desaprovar = mysql_fetch_array($rs)[0];
		?>
		<div id="inner-content">
			<div id="materia-content">
				<img src="images/<?php echo $capa; ?>" style="width: 530px; height: 300px;"/>
				<h1><?php echo $titulo ?></h1>
				<h3><?php echo $subtitulo ?></h3>
				<?php echo $conteudo; ?>
				<h6> por <?php echo $autorNome.' '.$autorSobrenome; ?></h6>
			</div>
			<button onclick="insert(1, <?php echo $id; ?>)">Aprovar</button><span id="aprovar"><?php echo ' '.$aprovar; ?></span>
			<button onclick="insert(0, <?php echo $id; ?>)">Desaprovar</button><span id="desaprovar"><?php echo ' '.$desaprovar; ?></span>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/materia.js" type="text/javascript"></script>
		<script src="js/aprovar.js" type="text/javascript"></script>
	</body>
</html>