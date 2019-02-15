<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
    require_once '../../componentes/BarraNavegacion.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $idUsuario = $_SESSION['id_user'];
    $url = "";
    $nombre = "";
    //Se verifica si se ha recibido un nuevo enlace
    if(isset($_POST['anadir'])){
        $idUsuario = $_SESSION['id_user'];
        $url = $_POST['url'];
        $nombre = $_POST['nombre'];
        $idTipo = $_POST['tipo'];
        //Se crea la instancia del enlace
        $enlace = new Enlace(null, $idUsuario, $url, $nombre, $idTipo);
        //Se inserta en la BBDD
        $bbdd = new BBDDEnlaces();
        $mensaje = $bbdd->anadirEnlace($enlace);    
    }
?>
<?php
    //Bloque para obtener los tipos de enlaces del usuario
    $bbddTipos = new BBDDTiposEnlace();
    $arrayTipos = $bbddTipos->obtenerTiposEnlace($idUsuario);
?>
<?php
    //Bloque para obtener los enlaces del usuario
    $bbddEnlaces = new BBDDEnlaces();
    $arrayEnlaces = $bbddEnlaces->obtenerEnlaces($idUsuario, '%');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Gestionar Enlaces</title>
		<link type="image" rel="shortcut icon" href="../../recursos/imagenes_pagina/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../../css/reset.css">
        <link type="text/css" rel="stylesheet" href="../../css/styles.css">
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
				<div class="contenedor-seccion">
					<div class="contenedor-seccion-principal">
						<div class="cabecera-seccion">
							<h3>Añadir Enlace</h3>
						</div>
						<div class="cuerpo-seccion">
							<?php if(isset($mensaje)) echo '<div>'.$mensaje.'</div>'; ?>
							<div>
								<?php
									//Se verifican que existan tipos de enlace para el usuario
									if(count($arrayTipos) > 0){
										echo '<form method="post">',
											'<div>';
                                                                                                if($url != "" and $nombre != ""){
                                                                                                    echo '<input type="url" name="url" value="'.$url.'" required />';
                                                                                                    echo '<input type="text" name="nombre" value="'.$nombre.'" required />';
                                                                                                }
                                                                                                else{
                                                                                                    echo '<input type="url" name="url" placeholder="Direccion URL" required />';
                                                                                                    echo '<input type="text" name="nombre" placeholder="Nombre para el enlace" required />';
                                                                                                }
												echo '<select name="tipo">';
												//Se imprimen los tipos de enlace del usuario
												foreach($arrayTipos as $tipoEnlace){
													echo '<option value="'.$tipoEnlace->getId().'">'.$tipoEnlace->getNombre().'</option>';
												}
												echo '</select>',
												'<input type="submit" value="Añadir" name="anadir" />',
												'</div>',
										'</form>';
									}
									else{
										echo '<p>Añada una categoria para posteriormente poder añadir los enlaces que desee a esta.</p>';
										echo '<a href="../tipos/gestionar_tipos.php">Añadir categoria</a>';
									}
								?>
							</div>
						</div>
					</div>
					<div class="contenedor-seccion-principal">
						<div class="cabecera-seccion">
							<h3>Gestionar Enlaces</h3>
						</div>
						<div class="cuerpo-seccion">
							<div>
								<?php
									if(count($arrayEnlaces) > 0){
										//Se muestran los enlaces y las opciones para modificar y borrar
										foreach ($arrayEnlaces as $enlace){
											echo '<form method="post" action="modificar_borrar_enlace.php">',
												'<input type="hidden" name="id_enlace" value="'.$enlace->getId().'" />',
												'<input type="hidden" name="id_usuaro" value="'.$enlace->getIdUsuario().'" />',
												'<p><b>Nombre:</b>'.$enlace->getNombre().'</p>',
												'<p><b>Url:</b>'.$enlace->getUrl().'</p>';
												//Se busca el tipo de enlace para imprimir este
												foreach($arrayTipos as $tipo){
													if($enlace->getIdTipo() == $tipo->getId()){
														echo '<p><b>Categoria:</b>'.$tipo->getNombre().'<p>';
													}
												}
												echo '<input style="display:inline" type="submit" name="modificar" value="Modificar" />',
												'<input style="display:inline" type="submit" name="eliminar" value="Eliminar" />',
											'</form>';
										}
									}
									else{
										echo '<p>Aún no ha añadido ningún enlace.</p>';
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
