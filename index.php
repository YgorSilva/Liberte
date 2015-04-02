<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
	</head>
	<body>
		<?php 
			if(isset($_GET['logout'])){
				session_unset(); 
				session_destroy();
			}
			if(isset($_SESSION['user'])) include 'template/userHeader.php';
			else include 'template/header.php';
		?>
		<div id="inner-content">
			<div id="galeria">
				<?php 
					$sql = 'select * from materias order by idMateria desc';
					$rs = mysql_query($sql, $con);
					$i = 0;
					while($mat[$i] = mysql_fetch_array($rs)){
						$sql = 'select * from usuarios where email = "'.$mat[$i]['autor'].'"';
						$rs2 = mysql_query($sql, $con);
						$autor[$i] = mysql_fetch_array($rs2);
						$i++;
					}
				?>
				<div class="main_img">
					<a id="slide_link" href="#"><div class="img_slider" id="img_slider"></div></a>
				</div>
				<div id="slide_bar"></div>
				<div class="slide_list">
					<div class="img_list 1" onmouseover="stoper(0);" onmouseout="autop();">
						<img id="img_1" src="images/<?php echo @$mat[0]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_1" href="materia.php?matId=<?php echo @$mat[0]['idMateria'] ?>"><h3><?php echo @$mat[0]['titulo']; ?></h3></a>
						<p><?php echo @$mat[0]['subtitulo']; ?></p>
						<h6>por <?php echo @$autor[0]['nome'].' '.@$autor[0]['sobrenome'] ?></h6>
					</div>
					<div class="img_list 2" onmouseover="stoper(1);" onmouseout="autop();">
						<img id="img_2" src="images/<?php echo @$mat[1]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_2" href="materia.php?matId=<?php echo @$mat[1]['idMateria'] ?>"><h3><?php echo @$mat[1]['titulo']; ?></h3></a>
						<p><?php echo @$mat[1]['subtitulo']; ?></p>
						<h6>por <?php echo @$autor[1]['nome'].' '.@$autor[1]['sobrenome'] ?></h6>
					</div>
					<div class="img_list 3" onmouseover="stoper(2);" onmouseout="autop();">
						<img id="img_3" src="images/<?php echo @$mat[2]['capa']; ?>" height="92px" width="162px" style="float: left; margin-right: 20px;">
						<a id="link_3" href="materia.php?matId=<?php echo @$mat[2]['idMateria'] ?>"><h3><?php echo @$mat[2]['titulo']; ?></h3></a>
						<p><?php echo @$mat[2]['subtitulo']; ?></p>
						<h6>por <?php echo @$autor[2]['nome'].' '.@$autor[2]['sobrenome'] ?></h6>
					</div>
				</div>
			</div>
		</div>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/slider.js" type="text/javascript"></script>
		<?php include 'template/footer.php'; ?>
	</body>
</html>