<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
    require_once '../../componentes/BarraNavegacion.php';
    require_once '../../componentes/PiePagina.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $idTipo = "";
    $idUsuario = $_SESSION['id_user'];
    //Bloque para obtener los enlaces del usuario
    if(isset($_GET['tipo'])){
        $idTipo = $_GET['tipo'];
        $bbddEnlaces = new BBDDEnlaces();
        $arrayEnlaces = $bbddEnlaces->obtenerEnlaces($idUsuario, $idTipo);
        //Se recupera la instancia del tipo de enlace de la BBDD
        $bbdd = new BBDDTiposEnlace();
        $tipoEnlace = $bbdd->obtenerTipoEnlace($idTipo);
    }
    else{
        //Se redirige a la pagina de eleccion de tipos de enlace
        header('Location: ver_tipos_enlaces.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Ver Enlaces por Categoria</title>
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
				<div class="contenedor-section">
					<div class="contenedor-seccion-principal">
						<div class="cabecera-seccion">
                			<h3><?php echo $tipoEnlace->getNombre(); ?></h3>
            			</div>
						<div class="cuerpo-seccion">
							<div>
								<?php
									if(count($arrayEnlaces) > 0){
										//Se muestran los enlaces
										foreach ($arrayEnlaces as $enlace){
											echo '<div>';
											echo '<a href="'.$enlace->getUrl().'" target="blank">';
											//Se imprime el favicon del sitio
											echo '<span><img width="32px" src="http://www.google.com/s2/favicons?domain='.$enlace->getUrl().'" alt="favicon"></span>';
											//Se imprime el nombre que el usuario le ha dado al enlace
											echo '<span>'.$enlace->getNombre().'</span>';
											echo '</a>';
											echo '</div>';
										}
									}
									else{
										echo '<p>Aún no ha añadido ningún enlace de este tipo.</p>';
										echo '<a href="gestionar_enlaces.php">Añadir enlaces</a>';
									}                 
								?>
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
