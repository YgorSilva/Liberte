<?php
	include '../PHP/connect.php';
	if(isset($_SESSION['user'])) include '../loggedIndex.php';
	else include '../login.php';
	include '../PHP/endConnect.php'
?>