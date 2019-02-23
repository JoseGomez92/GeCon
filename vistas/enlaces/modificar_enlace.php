<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../componentes/BarraNavegacion.php';
    require_once '../../componentes/PiePagina.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $mensaje = "";
    //Bloque para modificar los datos del tipo de enlace
    if(isset($_POST['id_enlace'])){
        //Se recuperan los datos del tipo de enlace
        $idEnlace = $_POST['id_enlace'];
        $url = $_POST['url'];
        $nombre = $_POST['nombre'];
        $idTipo = $_POST['id_tipo'];
        //Se crea el tipo de enlace
        $enlace = new Enlace($idEnlace, $url, $nombre, $idTipo);
        //Se obtiene la instancia del enlace de la BBDD
        $bbdd = new BBDDEnlaces();
        $mensaje = $bbdd->modificarEnlace($enlace);        
    }
    else{
        //Se redirige a la pagina de gestion de tipos
        header('Location: gestionar_enlaces.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Modificacion de Enlaces</title>
		<link type="image" rel="shortcut icon" href="../../recursos/imagenes_pagina/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../../css/reset.css">
        <link type="text/css" rel="stylesheet" href="../../css/styles.css">
        <link type="text/css" rel="stylesheet" href="../../css/borrado_modificado.css">
        <script type="text/javascript" src="../../js/redireccionar.js"></script>
    </head>
    <body>
        <div class="contenedor-body">
            <header>
				<table class="contenedor-header">
					<tr>
						<td class="contenedor-logo">
							<h3>Gecon</h3>
						</td>
						<td>
							<?php echo BarraNavegacion::crearMenu(); ?>
						</td>
					</tr>
				</table>
			</header>
			<section>
				<div class="contenedor-section">
					<div class="contenedor-seccion-principal">
						<div class="cabecera-seccion">
                			<h3>Modificación de Enlace</h3>
            			</div>
						<div class="cuerpo-seccion">
							<?php if(isset($mensaje)) echo '<div>'.$mensaje.'</div>'; ?>
							<div>
								<a href="gestionar_enlaces.php">Volver</a>
							</div>
						</div>
					</div>
				</div>
			</section>
                        <?php
                            //Se pinta el pie de pagina
                            echo PiePagina::obtenerPiePagina();
                        ?>
        </div>
    </body>
</html>
