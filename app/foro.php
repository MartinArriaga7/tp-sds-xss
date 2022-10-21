<?php

require_once("common.php");

$user_name = "";
if(isset($_SESSION["userId"])){
	$query = "SELECT userName FROM user WHERE id = {$_SESSION["userId"]}";
	$result_set = $connection->query($query);
	$result = array();
    $result[] = $result_set->fetch_assoc();
	if(isset($result[0]) && !empty($result[0])){
		$user_name = $result[0]["userName"];
	}
	
}else{
	header("Location: index.php");
	exit;
}
$message = "";
if(isset($_POST['btnEnviar'])){
	if(isset($_POST["txtComentario"]) && !empty($_POST["txtComentario"])){
		global $connection;
        $comment= $_POST["txtComentario"];
		// $comment = str_replace("<","&lt", $_POST["txtComentario"]);
        // $comment = str_replace(">","&gt", $comment);	
		$insercion = "INSERT INTO comment (comment, idUsuario) VALUES ('{$comment}',{$_SESSION["userId"]})";
		if ($connection->query($insercion)) {
			$message = "Comentario cargado";
		}else{
			
			$message = "Error al tratar de cargar comment: ".$connection->error;
		}
	}
}
$query = "SELECT userName as user_name, comment FROM comment c INNER JOIN  user u ON c.idUsuario = u.id";
$result_set = $connection->query($query);
$result = array();
if ($result_set !== false) {
	for ($i = 0; $i < $result_set->num_rows; $i++) {
		$result[] = $result_set->fetch_assoc();
	}
}
$comments = $result;

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
            <?php if(isset($user_name)):?>
                <div class="texto">
                    Usuario logueado: <?php echo $user_name;?>
                    &nbsp;&nbsp;
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
                    <textarea name="txtComentario" class="form-control" id="exampleFormControlTextarea1" placeholder="Ingrese su comment..." rows="5"></textarea>
                </div>
            
            </div>
            
            <div class="row justify-content-between">

                <div class="col-4">
                    <?php if(!empty($message)):?>
                        <span><?php echo $message;?></span>
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

<?php if(isset($comments) && !empty($comments)):?>
    <br/>
    <h2>Comentarios realizados</h2> 
    <?php foreach($comments as $comment): ?>          
   
            <!-- Forum List -->
            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                <div class="card mb-2">
                    <div class="card-body p-2 p-sm-3">
                        <div class="media forum-item">
                            <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://i.pinimg.com/564x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                            <div class="media-body">
                                <h6><?php echo $comment["user_name"]; ?></h6>
                                <p class="text-secondary">
                                <?php echo $comment["comment"]; ?>
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