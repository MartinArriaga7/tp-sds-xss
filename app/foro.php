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
                <div>
                    Usuario logueado: <span id="nombre_usuario"><?php echo $nombre_usuario;?></span>
                    <a href="cerrar_sesion.php">[cerrar sesi&oacuten]</a>
                </div>
		    <?php endif;?>
        
            <div class="d-flex align-items-center p-4 my-3 text-white bg-warning rounded shadow-sm">  
            
            
                    <h1>Foro SDS</h1>
            </div>
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Ingrese su comentario..." rows="5"></textarea>
        </div>
    </div>
    <div clas="row form-group">
        <div class="col d-flex justify-content-end">
            <button type="button" class="btn btn-primary">Enviar</button>
        <div>
    </div>
</div>
<div class="main-body p-0">
    <div class="inner-wrapper row justify-content-end">
    
    
    
    
    

    </div>
   
     

            <!-- Forum List -->
            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                <div class="card mb-2">
                    <div class="card-body p-2 p-sm-3">
                        <div class="media forum-item">
                            <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                            <div class="media-body">
                                <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body">Realtime fetching data</a></h6>
                                <p class="text-secondary">
                                    lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                                </p>
                                <p class="text-muted"><a href="javascript:void(0)">drewdan</a> replied <span class="text-secondary font-weight-bold">13 minutes ago</span></p>
                            </div>
                            <div class="text-muted small text-center align-self-center">
                                <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                                <span><i class="far fa-comment ml-2"></i> 3</span>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
                            
    </div>

   






	
	</body>
</html>