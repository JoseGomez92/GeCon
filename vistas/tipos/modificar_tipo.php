<?php
    require_once '../../funciones/remplazarCaracteres.php';
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/GestionImagen.php';
    require_once '../../modelos/TipoEnlace.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
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
    if(isset($_POST['id_tipo'])){
        $c = true;//Variable para controlar la subida de la imagen
        //Se recuperan los datos del tipo de enlace
        $idTipo = $_POST['id_tipo'];
        $idUsuario = $_POST['id_usuario'];
        $nombre = remplazarCaracteres($_POST['nombre']);
        $imagen = $_POST['imagen'];
        //Se verifica si se ha recibido una imagen para poner esta
        if(isset($_FILES['nueva_imagen']) && $_FILES['nueva_imagen']['name'] != ''){
            //Se verifica que se ha recibido una imagen con extension PNG o JPG
            if(GestionImagen::comprobarExtensionImagen($_FILES['nueva_imagen'])){
                //Se borra la imagen anterior
                if(GestionImagen::eliminarImagen($imagen)){
                    //Se sube la imagen al servidor
                    $nombreImagen = reemplazarEspacios($nombre);
                    $imagen = GestionImagen::subirImagen($_FILES['nueva_imagen'], $idUsuario, $nombreImagen);
                    $c = true;
                    //Se indica que la imagen ha sido modificada con exito.
                    $mensaje .= '<p class="mensaje-exito">Imagen modificada correctamente.</p>';
                }
            }
            else{
                $c = false;
            }
        }
        if($c){
            //Se modifica el tipo de enlace
            $tipoEnlace = new TipoEnlace($idTipo, $idUsuario, $nombre, $imagen);
            //Se crea una instancia de la BBDD para operar con tipos de enlace
            $bbdd = new BBDDTiposEnlace();
            $mensaje .= $bbdd->modificarTipoEnlace($tipoEnlace);
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
        <title>GeCon - Modificacion de Categorias</title>
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
							<h3>Modificacion de Categoria</h3>
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
                        <?php
                            //Se pinta el pie de pagina
                            echo PiePagina::obtenerPiePagina();
                        ?>
        </div>
    </body>
</html>
