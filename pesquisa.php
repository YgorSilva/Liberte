<html>
	<head>
		<?php include 'PHP/connect.php'; ?>
		<title>Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/tags.css"/>
		<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			include 'template/userHeader.php';
		 	include 'template/navBar.php';
		 	include 'template/actionBar.php';
		?>
		<div id='tagDiv'>
		</div>
		<?php
		 	include 'template/gridContainer.php'; 
		?>
		<script src="js/getSearchResult.js" type="text/javascript"></script>
		<script src="js/setVote.js" type="text/javascript"></script>
		<?php include 'PHP/endConnect.php'; ?>
	</body>
</html>