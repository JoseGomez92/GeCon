<?php
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
    $idUsuario = $_SESSION['id_user'];
    //Se obtienen los tipos de enlace de la BBDD
    $bbdd = new BBDDTiposEnlace();
    $arrayTipos = $bbdd->obtenerTiposEnlace($idUsuario);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Ver Tipos de Enlaces</title>
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
                            <h3>¿Que quieres visitar?</h3>
                        </div>
                        <div class="cuerpo-seccion">
                            <?php
                                //Se muestran los tipos de enlace del usuario
                                if (count($arrayTipos) > 0) {
                                    echo '<div class="items-seccion">';
                                    foreach ($arrayTipos as $tipo) {
                                        echo '<div class="item">';
                                        echo '<a href="ver_enlaces_por_tipo.php?tipo=' . $tipo->getId() . '">',
                                        '<img height="100px" src="../../recursos/iconos_tipos_enlaces/' . $tipo->getImagen() . '" alt="' . $tipo->getImagen() . '">',
                                        '<p>' . $tipo->getNombre() . '</p>',
                                        '</a>';
                                        echo '</div>';
                                    }
                                    echo '<div>';
                                } else {
                                    echo '<p>¡Vaya! Aún no hay ningún Tipo de enlace para poder ver.</p>';
                                    echo '<a href="gestionar_enlaces.php">Añadir un enlace</a>';
                                }
                            ?>
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
