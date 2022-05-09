<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	if (isset($_SESSION['zalogowany'])&&$_SESSION['user']!="admin")
	{
		header('Location: panel.php');
		exit();
	}
	
	require_once 'database.php';
	
	?>
<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Panel admin</title>
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.4.min.js"></script>		
		<script src="js/jquery-ui.min.js"></script>	
		<script src="js/js3.js"></script>		
		<link rel="stylesheet" href="css/jquery-ui.min.css"/>	
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="shortcut icon" href="#">	

	</head>
<body>
	<?php
		$_SESSION['$today'] = date("Y.m.d");  
		echo '<div class="logout_data">Zalogowany:
			<span class="logout_data_user">'.$_SESSION['user'].'</span>
			<span class="logout_data_date">'.$_SESSION['$today'] .'</span>
			<a class="logout_data_logout" href="logout.php">[ Wyloguj ]</a>
		</div>';
	?>
	

</body>
</html>