<?php

require_once("common.php");

$nombre_usuario = "";
if(isset($_SESSION["userId"])){
	$consulta = "SELECT userName FROM user WHERE id = {$_SESSION["userId"]}";
	$conjunto_resultados = $connection->query($consulta);
	$resultados = array();
    $resultados[] = $conjunto_resultados->fetch_assoc();
	if(isset($resultados[0]) && !empty($resultados[0])){
		$nombre_usuario = $resultados[0]["userName"];
	}
	
}else{
	header("Location: index.php");
	exit;
}
$mensaje = "";
if(isset($_POST['btnEnviar'])){
	if(isset($_POST["txtComentario"]) && !empty($_POST["txtComentario"])){
		global $connection;
        $comment= $_POST["txtComentario"];
		// $comment = str_replace("<","&lt", $_POST["txtComentario"]);
        // $comment = str_replace(">","&gt", $comment);	
		$insercion = "INSERT INTO comment (comment, idUsuario) VALUES ('{$comment}',{$_SESSION["userId"]})";
		if ($connection->query($insercion)) {
			$mensaje = "Comentario cargado";
		}else{
			
			$mensaje = "Error al tratar de cargar comentario: ".$connection->error;
		}
	}
}
$consulta = "SELECT userName as nombre_usuario, comment FROM comment c INNER JOIN  user u ON c.idUsuario = u.id";
$conjunto_resultados = $connection->query($consulta);
$resultados = array();
if ($conjunto_resultados !== false) {
	for ($i = 0; $i < $conjunto_resultados->num_rows; $i++) {
		$resultados[] = $conjunto_resultados->fetch_assoc();
	}
}
$comentarios = $resultados;

?>

<html>
	<head>
		<title>Foro</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
		<link type="text/css" href="styles/style.css" rel="stylesheet"/>
        
		<script src="jquery-1.9.1.min.js" type="text/javascript" ></script>
	</head>
	<body>
    
    
<div class="container">
        
    <div class="row form-group">
        <div class="col" >
            <?php if(isset($nombre_usuario)):?>
                <div class="texto">
                    Usuario logueado: <?php echo $nombre_usuario;?>
                    <a href="cerrar_sesion.php" color="red">[cerrar sesi&oacuten]</a>
                </div>
		    <?php endif;?>
        
            <div class="d-flex align-items-center p-4 my-3 text-white bg-warning rounded shadow-sm">  
                    <h1>Foro SDS</h1>
            </div>
        </div>
    </div>
    <form method="post" action="foro.php">
    
        <div class="container">
            <div class="row form-group">
                <div class="col">
                    <textarea name="txtComentario" class="form-control" id="exampleFormControlTextarea1" placeholder="Ingrese su comentario..." rows="5"></textarea>
                </div>
            
            </div>
            
            <div class="row justify-content-between">

                <div class="col-4">
                    <?php if(!empty($mensaje)):?>
                        <span><?php echo $mensaje;?></span>
                    <?php endif;?>
                </div>
                <div class="col-2">
                    <input id="btnEnviar" name="btnEnviar" type="submit">
                <div>
            </div>
        </div>
    </form>
</div>


<div class="main-body p-0">

<?php if(isset($comentarios) && !empty($comentarios)):?>
    <br/>
    <h2>Comentarios realizados</h2> 
    <?php foreach($comentarios as $comentario): ?>          
   
            <!-- Forum List -->
            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                <div class="card mb-2">
                    <div class="card-body p-2 p-sm-3">
                        <div class="media forum-item">
                            <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://i.pinimg.com/564x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                            <div class="media-body">
                                <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body"><?php echo $comentario["nombre_usuario"]; ?></a></h6>
                                <p class="text-secondary">
                                <?php echo $comentario["comment"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
    <?php endforeach; ?>
    <?php endif; ?>
                            
</div>

   






	
	</body>
</html>