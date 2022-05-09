<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: panel.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Logowanie do panel sprzedaży</title>
	<link rel="stylesheet" href="css/style.css"/>
	<script src="js/js.js" async></script>
	<link rel="shortcut icon" href="#">
	<link href="//db.onlinewebfonts.com/c/1cfac2832ad49f16a3ea6b5c2287af2f?family=Mistral" rel="stylesheet" type="text/css"/> 
</head>

<body>	

	<div class="container">
		<form action="zaloguj.php" method="post" >
			<input type="text" name="login" placeholder="login" id="login_log" autocomplete="off" />
			<input type="password" name="haslo" placeholder="hasło" id="pass_log" autocomplete="off" />
			<input type="submit" value="Zaloguj się" />
		</form>
		<div class="alert">	
		<?php
			if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		?>
	</div>
	
	<div class="logo" >Bukowski</div>
	
	
	</div>
	

	
</body>

</html>