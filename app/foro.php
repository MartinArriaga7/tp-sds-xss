<?php

require_once("common.php");

$userName = "";
$error=false;
$userId = "";
if(isset($_SESSION["userId"])){
    $userId = $_SESSION["userId"];
	$query = "SELECT userName FROM user WHERE id = {$userId}";
	$result_set = $connection->query($query);
    $result = $result_set->fetch_assoc();
	if(isset($result[0]) && !empty($result[0])){
		$userName = $result[0]["userName"];
	}
}else{
	header("Location: index.php");
	exit;
}

$message = "";
if(isset($_POST["btnSend"]) && isset($_POST["txtComment"]) && !empty($_POST["txtComment"])){
    global $connection;
    $comment = $_POST["txtComment"];
    // $comment = str_replace("<","&lt", $_POST["txtComment"]);
    // $comment = str_replace(">","&gt", $comment);
    $insercion = "INSERT INTO comment (comment, idUsuario) VALUES ('{$comment}',{$_SESSION["userId"]})";
    if ($connection->query($insercion)) {
        $message = "Comentario cargado";
    } else {
        $message = "Error al tratar de cargar comentario: ".$connection->error;
        $error = true;
    }
} else {
    $message = "No puedes insertar comentarios vacios...";
}

$query = "SELECT userName as userName, comment FROM comment JOIN  user ON comment.idUsuario = user.id";
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" 
              integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
		<link type="text/css" href="styles/style.css" rel="stylesheet"/>
		<script src="jquery-1.9.1.min.js" type="text/javascript" ></script>
	</head>
	<body>

        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <?php if(isset($userName)):?>
                        <div class="texto">
                            Bienvenido <?php echo $userName;?>
                            &nbsp;&nbsp;
                            <a href="cerrar_sesion.php" color="red">[cerrar sesi&oacuten]</a>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex align-items-center p-4 my-3 text-white bg-warning rounded shadow-sm">
                    <h1>Foro - Seguridad en el Desarrollo de Software</h1>
                </div>

            </div>

            <form method="post" action="foro.php">
                <div class="container">

                    <div class="row form-group">
                        <div class="col">
                            <textarea name="txtComment" class="form-control" id="exampleFormControlTextarea1" placeholder="Ingrese su comentario..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <?php if(!empty($message)):?>
                                    <span ><?php echo $message;?></span>
                            <?php endif;?>
                        </div>
                        <div class="col-2">
                            <input id="btnSend" name="btnSend" type="submit">
                        <div>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <?php if(isset($comments) && !empty($comments)):?>
                <br/>
                <h2>Comentarios realizados</h2>
                <hr/>
                <?php foreach($comments as $comment): ?>
                    <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                        <div class="card mb-2">
                            <div class="card-body p-2 p-sm-3">
                                <div class="media forum-item">
                                    <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://i.pinimg.com/564x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                                    <div class="media-body">
                                        <h6><?php echo $comment["userName"]; ?></h6>
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
