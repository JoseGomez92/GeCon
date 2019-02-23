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
    $pathImagenFondo = "";
    //Bloque para obtener los enlaces del usuario
    if(isset($_GET['tipo'])){
        $idTipo = $_GET['tipo'];
        $bbddEnlaces = new BBDDEnlaces();
        $arrayEnlaces = $bbddEnlaces->obtenerEnlaces($idTipo);
        //Se recupera la instancia del tipo de enlace de la BBDD
        $bbdd = new BBDDTiposEnlace();
        $tipoEnlace = $bbdd->obtenerTipoEnlace($idTipo);
        //Se forma el path para la imagen de fondo del contenedor de enlaces
        $pathImagenFondo = "../../recursos/iconos_tipos_enlaces/".$tipoEnlace->getImagen();
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
        <link type="text/css" rel="stylesheet" href="../../css/enlaces_por_tipo.css">
        <style>
            /* Se indica la imagen de fondo para el el contenedor de enlaces */
            .contenedor-enlaces{ 
                background: url(<?php echo $pathImagenFondo ?>) no-repeat center center;
                background-size: 150px;
                position:relative;
                color: white;
                z-index:1;
            }
            .contenedor-enlaces::after{
                content:"";
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:100%;
                background:rgba(36,36,36,.75);
                z-index:-1;
            }
        </style>
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
                            <div class="contenedor-enlaces">
				<?php
                                    if(count($arrayEnlaces) > 0){
					//Se muestran los enlaces
					foreach ($arrayEnlaces as $enlace){
                                            echo '<div class="enlace">';
                                            echo '<a href="'.$enlace->getUrl().'" target="blank">';
                                            //Se imprime el favicon del sitio
                                            echo '<div><span><img class="favicon" src="http://www.google.com/s2/favicons?domain='.$enlace->getUrl().'" alt="favicon"></span>';
                                            //Se imprime el nombre que el usuario le ha dado al enlace
                                            echo '<span>'.$enlace->getNombre().'</span></div>';
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
