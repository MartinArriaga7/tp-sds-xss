<?php

require_once("common.php");

$error = "";
if(isset($_POST['submit'])){
	if(verificar_usuario($_POST['username'],$_POST['password']) === true){
		$conjunto_resultados = $connection->query("SELECT * FROM user WHERE userName='{$_POST['username']}'");
		$resultados = array();
		$resultados[] = $conjunto_resultados->fetch_assoc();
		if(!empty($resultados[0])){
			$_SESSION["id_usuario"] = $resultados[0]["id"];
			header("Location: foro.php");
			exit;
		}
	}
	$error = "Usuario incorrecto";
}
function verificar_usuario($username, $password){
	global $connection;
	$conjunto_resultados = $connection->query("SELECT * FROM user WHERE userName='{$username}'");
	$resultados = array();
	$resultados[] = $conjunto_resultados->fetch_assoc();
	if(!empty($resultados)){
		$clave_bd = $resultados[0]["password"];
		if($password == $clave_bd){
			return true;
		}
	}
	return false;
}

?>

<html>
<head>
<title>Foro</title>
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
<h1>Ingreso a Foro</h1>
<div class="header agile">
	<div class="wrap">
		<div class="login-main wthree">
			<div class="login">
			<h3>Iniciar sesión</h3>
			<form action="#" method="post">
				<input type="text" placeholder="Usuario" required="" name="username" required>
				<input type="password" placeholder="Contraseña" name="password" required>
				<input name="submit" type="submit" value="Ingresar">
			</form>
			
            <?php if(!empty($error)):?>
                <span><?php echo $error; ?></span>
		<?php endif;?>
			
			
		</div>
	</div>
</div>
<!--header end here-->
<!--copy rights end here-->
<div class="copy-rights w3l">		 	
	<p>© <?php echo date("Y");?> Seguridad en Desarrollo de Software | XSS </p>		 	
</div>
<!--copyrights start here-->
 
</body>
</html>
