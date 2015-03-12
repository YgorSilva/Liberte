<html>
	<head>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
	</head>
	<body>
		<?php include 'template/header.php'; ?>
		<div id="inner-content">
			<div id="galeria">
				<?php 
					$sql = 'select * from materia order by id desc';
					$rs = mysql_query($sql, $con);
					$i = 0;
					while($mat[$i] = mysql_fetch_array($rs)){
						$i++;
					}
					$i = 0;
					while($i < 3){
						$sql = 'select * from usuario where id = '.$mat[$i]['autor'];
						$rs = mysql_query($sql, $con);
						$reg = mysql_fetch_array($rs);
						$autor[$i] = $reg;
						$i++;
					}
				?>
				<div class="main_img">
					<a id="slide_link" href="#"><div class="img_slider" id="img_slider"></div></a>
				</div>
				<div id="slide_bar"></div>
				<div class="slide_list">
					<div class="img_list 1" onmouseover="stoper(0);" onmouseout="autop();">
						<img id="img_1" src="images/<?php echo $mat[0]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_1" href="materia.php?mat_id=<?php echo $mat[0]['id'] ?>"><h3><?php echo $mat[0]['titulo']; ?></h3></a>
						<p><?php echo $mat[0]['subtitulo']; ?></p>
						<h6>por <?php echo $autor[0]['nome'].' '.$autor[0]['sobrenome'] ?></h6>
					</div>
					<div class="img_list 2" onmouseover="stoper(1);" onmouseout="autop();">
						<img id="img_2" src="images/<?php echo $mat[1]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_2" href="materia.php?mat_id=<?php echo $mat[1]['id'] ?>"><h3><?php echo $mat[1]['titulo']; ?></h3></a>
						<p><?php echo $mat[1]['subtitulo']; ?></p>
						<h6>por <?php echo $autor[1]['nome'].' '.$autor[1]['sobrenome'] ?></h6>
					</div>
					<div class="img_list 3" onmouseover="stoper(2);" onmouseout="autop();">
						<img id="img_3" src="images/<?php echo $mat[2]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_3" href="materia.php?mat_id=<?php echo $mat[2]['id'] ?>"><h3><?php echo $mat[2]['titulo']; ?></h3></a>
						<p><?php echo $mat[2]['subtitulo']; ?></p>
						<h6>por <?php echo $autor[2]['nome'].' '.$autor[2]['sobrenome'] ?></h6>
					</div>
				</div>
			</div>
		</div>
		<?php include 'template/footer.php'; ?>
		<script src="js/slider.js" type="text/javascript"></script>
		<script src="js/menu-bar.js" type="text/javascript"></script>
	</body>
</html>