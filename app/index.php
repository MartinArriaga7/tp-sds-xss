<?php

require_once("common.php");

global $connection;
$error = "";
if(isset($_POST['btnLogin'])){
	$userName = htmlspecialchars(strip_tags($_POST['userName']));
	$password = htmlspecialchars(strip_tags($_POST['password']));
	$loginResult = verifyLogin($userName, $password, $connection);
	if (is_null($loginResult)) {
		$error = 'Usuario o contraseña no válidos';
	} else {
		$_SESSION['userId'] = $loginResult;
		header('Location: foro.php');
		exit;
	}
}

function verifyLogin(string $username, string $password, mysqli $connection): int|null{
	$conjunto_resultados = $connection->query("SELECT * FROM user WHERE userName='{$username}'");
	$resultados = $conjunto_resultados->fetch_assoc();
	$foundUserName = isset($resultados['id']) && isset($resultados['userName']) && isset($resultados['password']);
	if ($foundUserName && $password === $resultados['password']) {
		return $resultados['id'];
	}
	return null;
}

?>

<html>
<head>
<title>Login</title>
<!-- Custom Theme files -->
<link href="styles/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Flat Login Form Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Signika:400,600' rel='stylesheet' type='text/css'>
<!--google fonts-->
</head>
<body>
<!--header start here-->
<h1>Ingreso al Foro</h1>
<div class="header agile">
	<div class="wrap">
		<div class="login-main wthree">
			<div class="login">
			<h3>Iniciar sesión</h3>
			<form action="#" method="post">
				<input type="text" placeholder="Usuario" required="" name="userName" required>
				<input type="password" placeholder="Contraseña" name="password" required>
				<input name="btnLogin" type="submit" value="Ingresar">
			</form>
			
            <?php if(isset($error)):?>
                <span><?php echo $error; ?></span>
			<?php endif;?>
				
		</div>
	</div>
</div>
<!--header end here-->
<!--copy rights end here-->
<div class="copy-rights w3l">		 	
	<p>© <?php echo date("Y");?> TP Seguridad en Desarrollo de Software | XSS </p>		 	
</div>
<!--copyrights start here-->
 
</body>
</html>
