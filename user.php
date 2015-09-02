<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			if(isset($_SESSION['user'])) include 'template/userHeader.php';
			else include 'template/header.php';
		
			$vUser = new User();
			$vUser->feedData($_GET['e']);
			$vUserData = $vUser->getData();
		
			$sql = 'select * from assinaturas where assinante = "'.$userData['email'].'" and assinado = "'.$vUserData['email'].'"';
			$rs = mysql_query($sql);
			$row = mysql_fetch_array($rs);
			$signed = is_null($row[0])?1:0;
		?>
		<div id="inner-content">
			<center>
				<img src="images/<?=$vUserData['imgPerfil']?>">
				<p><?=$vUserData['nome'].' '.$vUserData['sobrenome']?></p>
				<input id="btnAssinar" type="button" onclick="assinar('<?=$vUserData["email"]?>', <?=$signed?>);" value="<?=$signed?'Assinar':'Assinado'?>"/>
			</center>
		</div>
		<script src="js/menu-bar.js" type="text/javascript"></script>
		<script src="js/slider.js" type="text/javascript"></script>
		<script src="js/assinar.js" type="text/javascript"></script>
		<?php include 'template/footer.php'; ?>
	</body>
</html>