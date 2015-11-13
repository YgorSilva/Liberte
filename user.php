<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/user.css"/>
		<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			include 'template/userHeader.php';
			include 'template/navBar.php';
			include 'template/actionBar.php';
			
			$vUser = new User();
			$vUser->feedData($_GET['id']);
			$vUserData = $vUser->getData();
			
			$publicacoes = '(select count(*) from materias where autor = '.$vUserData['id'].' and not isRascunho) as publicacoes'; 
			$assinantes = '(select count(*) from assinaturas where assinado = '.$vUserData['id'].') as assinantes';
			$assinando = '(select count(*) from assinaturas where assinante = '.$vUserData['id'].') as assinando';
			$sql = 'select '.$assinantes.', '.$assinando.', '.$publicacoes.', count(*) from assinaturas where assinante = '.$userData['id'].' and assinado = '.$vUserData['id'];
			$row = mysql_fetch_array(mysql_query($sql));
			$signed = $row[2];
			$user = unserialize($_SESSION['user']);	
			$userData = $user->getData();
		?>
		<div id='userPerfil'>
			<div id='userData'>
				<div class='userData'>
					<span class='userData'><?=$row['publicacoes']?></span></br>
					<button>Publicações</button>
				</div>
				<div class='userData'>
					<span class='userData'><?=$row['assinando']?></span></br>
					<button>Assinando</button>
				</div>
				<div class='userData'>
					<span class='userData'><?=$row['assinantes']?></span></br>
					<button>Assinantes</button>
				</div>
			</div>
			<div id='userMain'>
				<center>
					<a class='user' href='user.php?id=<?=$vUserData["id"]?>'><?=$vUserData['nome'].' '.$vUserData['sobrenome']?></a></br>
					<img class='user' src="images/<?=$vUserData['imgPerfil']?>"/></br>
					<?=($vUserData['id'] == $userData['id']?'':'<button class="signingBtn '.($signed?"already":"").'" onclick="assinar('.$signed.')">'.($signed?'Assinado':'Assinar').'</button>')?>
				</center>
			</div>
			<div id='userBio'>
				Bio do Usuário
			</div>
		</div>
		<?php include 'template/gridContainer.php'; ?>
		<?=($vUserData['id'] == $userData['id']?'':'<script src="js/assinar.js" type="text/javascript"></script>')?>
		<script src="js/getUserFeed.js" type="text/javascript"></script>
	</body>
</html>