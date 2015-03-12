<html>
	<head>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/nova-materia.css"/>
	</head>
	<body>
		<?php include 'template/user_identify.php'; ?>
		<?php
			if($_FILES["capa"]['error']==0){
				$ext = substr($_FILES["capa"]["name"], strpos(strrev($_FILES["capa"]["name"]),".")*-1);
				$capa = md5(time().$_FILES["capa"]["name"]).".".$ext;
				move_uploaded_file($_FILES["capa"]["tmp_name"], "images/".$capa);
			}
			else{
				$_FILES["capa"] = 'capa_default.png';
			}
			$sql = 'insert materia (autor, capa, titulo, subtitulo) values("'.$id.'","'.$capa.'","'.$_POST['elmt'][0].'","'.$_POST['elmt'][1].'")';
			$rs = mysql_query($sql, $con);
			$sql = 'select id from materia where autor = '.$_GET['id'].' order by id desc';
			$rs = mysql_query($sql, $con);
			$reg = mysql_fetch_array($rs);
			for ($i=2; $i < sizeof($_POST['elmt']); $i++) { 
				$sql = 'insert paragrafo (materia, conteudo) values("'.$reg['id'].'", "'.$_POST['elmt'][$i]	.'")';
				$rs = mysql_query($sql, $con);
			}
		?>
		<div id="inner-content">
			<div id="materia-content">
				<img src="images/<?php echo $capa; ?>" style="width: 530px; height: 300px;"/>
				<h1><?php echo $_POST['elmt'][0] ?></h1>
				<h3><?php echo $_POST['elmt'][1] ?></h3>
				<?php
					for ($i=2; $i < sizeof($_POST['elmt']); $i++) {
						echo $_POST['elmt'][$i];					
					}
				?>
				<h6> por <?php echo $nome.' '.$sobrenome; ?></h6>
			</div>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/materia.js" type="text/javascript"></script>
	</body>
</html>