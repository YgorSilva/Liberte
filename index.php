<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			include 'C:\xampp\htdocs\Liberte\PHPClasses\userClass.php';
			if(isset($_SESSION['user'])) $user = unserialize($_SESSION['user']);
			else{
				$user = new User();
				$user->login('martines.lucas@bol.com.br', 'caracolis1');
				$_SESSION['user'] = serialize($user);
			}	
			$userData = $user->getData();
			
			include 'template/userHeader.php';
		 	include 'template/navBar.php';
		?>
		<div id='actionBar'>
			<a href='escrever.php'><img src='layoutImages/Caneta.png' title='Escrever matéria' width='80px' height='70px'/></a>
			<div class='notifDiv'>
				<img class='notifBtn' src='layoutImages/notifBtn.png' title='Notificações' width='40px' height='40px'/>
				<div class='notifContent'></div>
			</div>
		</div>
		<?php 
		 	include 'template/gridContainer.php'; 
		?>
		<script src="js/getFeed.js" type="text/javascript"></script>
		<script src="js/setVote.js" type="text/javascript"></script>
		<script src="js/notifDiv.js" type="text/javascript"></script>
		<script src="js/getNotifications.js" type="text/javascript"></script>
		<?php include 'PHP/endConnect.php'; ?>
	</body>
</html>