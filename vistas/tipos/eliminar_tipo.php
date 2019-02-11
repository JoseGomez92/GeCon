<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/GestionImagen.php';
    require_once '../../modelos/TipoEnlace.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
    require_once '../../componentes/BarraNavegacion.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $mensaje = "";
    //Bloque para modificar los datos del tipo de enlace
    if(isset($_POST['id_tipo'])){
        //Se recuperan los datos del tipo de enlace
        $idTipo = $_POST['id_tipo'];
        $idUsuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $imagen = $_POST['imagen'];
        //Se crea el tipo de enlace
        $tipoEnlace = new TipoEnlace($idTipo, $idUsuario, $nombre, $imagen);
        //Se elimina la imagen del servidor para el tipo
        if(GestionImagen::eliminarImagen($imagen)){
            //Se recupera la instancia del enlace de la BBDD
            $bbdd = new BBDDTiposEnlace();
            if($bbdd->eliminarTipoEnlace($tipoEnlace)){
                $mensaje = '<p class="mensaje-exito">Categoria eliminada correctamente.</p>';
            }
            else{
                $mensaje = '<p class="mensaje-error">Error. No se pudo eliminar el Tipo de Enlace.</p>';
            }
        }
        else{
            $mensaje = $mensaje = '<p class="mensaje-error">Error. No se pudo eliminar la imagen asociada al Tipo de Enlace.</p>';
        }
    }
    else{
        //Se redirige a la pagina de gestion de tipos
        header('Location: gestionar_tipos.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Borrado de Categorias</title>
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
							<h3>Borrado de Categoria</h3>
						</div>
						<div class="cuerpo-seccion">
							<?php if(isset($mensaje)) echo '<div>'.$mensaje.'</div>'; ?>
							<div>
								<a href="gestionar_tipos.php">Volver</a>
							</div>
						</div>
					</div>
				</div>
			</section>
        </div>
    </body>
</html>
