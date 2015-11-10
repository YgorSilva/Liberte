<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/posts.css"/>
		<link rel="stylesheet" type="text/css" href="style/materia.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			$id = $_GET['matId'];
			include 'C:\xampp\htdocs\Liberte\PHPClasses\dateClass.php';
			include 'template/userHeader.php';

			$already = 'if(
				(select count(*) from aprovarDesaprovar where usuario = '.$userData['id'].' and materia = a.idMateria) = 0, 
				NULL, 
				(select isPositivo from aprovarDesaprovar 
				where usuario = '.$userData['id'].' and materia = a.idMateria)) 
				as already';
			$authorName = '(select concat(nome, " ", sobrenome) from usuarios where userid = a.autor) as authorName';
			$aproves = '(select count(*) from aprovarDesaprovar where isPositivo and materia = a.idMateria) as aproves';
			$desaproves = '(select count(*) from aprovarDesaprovar where not isPositivo and materia = a.idMateria) as desaproves';
			$sql = 'select a.*, '.$already.', '.$authorName.', '.$aproves.', '.$aproves.', '.$desaproves.' from materias as a where idMateria = "'.$id.'"';
			$mat = mysql_fetch_array(mysql_query($sql));
			$date = new Date();
			$date->setSqlDate($mat['date']);
			include 'template/navBar.php';
			include 'template/actionBar.php';
		?>
		<div id='inner-content'>
			<div id="materia-content">
				<div id='info'>
					<a href='user.php?<?=$mat['autor']?>'><div class='authorDiv'>
						<img class='authorImg' src='layoutImages/PHFeh.jpg' width='30px' height='30px'/>
						<div><?=$mat['authorName']?></div>
					</div></a>
					<h5 style='float: right; margin-bottom: 0;'><?=$date->getDisplayableDate()?></h5>
				</div>
				<h1><?=$mat['titulo']?></h1>
				<img id='cover' src="images/<?=$mat['capa']?>" style="width: 80%; margin-left: 10%;"/>
				<h3><?=$mat['subtitulo']?></h3>
				<span id="content"><?=$mat['conteudo']?></span>
				<?php
					if($userData['id'] == $mat['autor']) echo '<a class="sub" href="editar.php?matId='.$id.'">Editar</a>';
					else{
						echo '<a href="user.php?e='.$mat['autor'].'"><h6>por '.$mat['authorName'].'</h6></a>';
						echo '<a onclick="setDenuncia(this)"><h6>Denunciar</h6></a>';
					} 	
				?>
			</div>
			<div id='interact'>
				<button class='btnVote btnAprova<?=($mat['already'] == null?'r' : ($mat['already']? 'do' : 'r'))?>'>
				</button>
				<span class="n aprovar"><?=$mat['aproves']?></span>
				<button class='btnVote btnDesaprova<?=($mat['already'] == null? 'r' : ($mat['already']? 'r' : 'do'))?>'>
				</button>
				<span class="n desaprovar"><?=$mat['desaproves']?></span>
				<input id='commentInput' class='commentInput' type='text' placeholder='Comente sobre isso!' name='comment'/>
				<button id='btnComment' onclick="setComment(this)">Comentar</button>
				<div id='comments' class='comments'></div>
			</div>
		</div>
		<?php include 'PHP/endConnect.php'; ?>
		<script src="js/materia.js" type="text/javascript"></script>
		<script src="js/setVote.js" type="text/javascript"></script>
	</body>
</html>