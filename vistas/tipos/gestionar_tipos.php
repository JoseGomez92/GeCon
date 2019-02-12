<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../funciones/remplazarCaracteres.php';
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
    $bbdd = new BBDDTiposEnlace();
    $idUsuario = $_SESSION['id_user'];
    //Se verifica si se ha recibido un nuevo enlace
    if(isset($_POST['anadir'])){;
        $nombre = remplazarCaracteres($_POST['nombre']);
        $imagen = "";
        $c = false;//Variable para controlar la subida de la imagen
        //Se verifica si se ha recibido una imagen (por defecto PHP manda un archivo llamado '.' o '..')
        if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != ''){
            //Se verifica que se ha recibido una imagen con extension PNG o JPG
            if(GestionImagen::comprobarExtensionImagen($_FILES['imagen'])){
                //Se sube la imagen al servidor
                $imagen = GestionImagen::subirImagen($_FILES['imagen'], $idUsuario, $nombre);
                $c = true;
            }
        }   
        else{
            //Se pone la imagen por defecto
            $imagen = GestionImagen::subirImagenPorDefecto($idUsuario, $nombre);
            $c = true;
        }
        if(!$c){
             $mensaje = '<p class="mensaje-error">Error. No se pudo subir la imagen. Verifique que el tipo de fichero indicado es una imagen PNG o JPG.</p>';
        }
        else{
            //Se crea la instancia del tipo de enlace
            $tipoEnlace = new TipoEnlace(null, $idUsuario, $nombre, $imagen);
            //Se inserta en la BBDD        
            if($bbdd->anadirTipoEnlace($tipoEnlace)){
                $mensaje = '<p class="mensaje-exito">Categoria añadida correctamente</p>';
            }
            else{
                $mensaje = '<p class="mensaje-error">Error al añadir la categoria. Esta no se añadió.</p>';
            }  
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Gestionar Categorias</title>
		<link type="image" rel="shortcut icon" href="../../recursos/imagenes_pagina/favicon.png">
		<link type="image" rel="shortcut icon" href="../../recursos/imagenes_pagina/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../../css/reset.css">
        <link type="text/css" rel="stylesheet" href="../../css/styles.css">
        <link type="text/css" rel="stylesheet" href="../../css/gestion_tipos.css">
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
                			<h3>Añadir Categoria</h3>
            			</div>
						<div class="cuerpo-seccion">
							<?php
								if(isset($mensaje)) echo '<div>'.$mensaje.'</div>';
							?>
							<div>
								<form method="post" action="gestionar_tipos.php" enctype="multipart/form-data">
									<div>
										<input type="text" name="nombre" placeholder="Nombre para el tipo de enlace" required />
										<input type="file" name="imagen" />
										<input type="submit" value="Añadir" name="anadir" />
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="contenedor-seccion-principal">
						<div class="cabecera-seccion">
                			<h3>Gestionar Categorias</h3>
            			</div>
						<div class="cuerpo-seccion">
							<div>
								<?php
									//Se obtienen los tipos de enlace de la BBDD
									$arrayTipos = $bbdd->obtenerTiposEnlace($idUsuario);
									$pathImagenes = "../../recursos/iconos_tipos_enlaces";
									if(count($arrayTipos) > 0){
										//Se muestran los tipos de enlace y las opciones para modificar y borrar
										foreach ($arrayTipos as $tipo){
											echo '<form class="form-modificar-tipo" method="post" action="modificar_borrar_tipo.php">',
												'<input type="hidden" name="id_tipo" value="'.$tipo->getId().'" />',
												'<p><b>Categoria:</b>'.$tipo->getNombre().'</p>',
												'<div class="contenedor-icono">
													<span><b>Icono:</b></span>
													<span><img src="'.$pathImagenes.'/'.$tipo->getImagen().'" alt="'.$tipo->getImagen().'" /></span>
												</div>',
												'<input style="display:inline;" type="submit" name="modificar" value="Modificar" />',
												'<input style="display:inline;" type="submit" name="eliminar" value="Eliminar" />',
											'</form>';
										}
									}
									else{
										echo '<p>¡Oops! No ha registrado ninguna categoria. Añada una para poder añadir sus enlaces.</p>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
        </div>
    </body>
</html>
