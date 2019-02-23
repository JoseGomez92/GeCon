<?php
    require_once '../../funciones/comprobarLog.php';
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
    //Bloque para recuperar los datos del tipo de enlace
    $idTipo = -1;
    $tipoEnlace = null;
    $accion = "modificar";
    //Se verifica que se haya recibido el id del tipo de enlace
    if(isset($_POST['id_tipo'])){
        $idTipo = $_POST['id_tipo'];
        //Se verifica el tipo de accion a realizar
        if(isset($_POST['eliminar'])) $accion = "eliminar";
        //Se recupera la instancia del tipo de enlace de la BBDD
        $bbdd = new BBDDTiposEnlace();
        $tipoEnlace = $bbdd->obtenerTipoEnlace($idTipo);
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
        <title>GeCon - Modificar o Borrar Categorias</title>
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
                            <?php
                                if($accion == 'modificar') echo '<h3>Modificar Categoria</h3>';
                                else echo '<h3>Eliminar Categoria</h3>';
                            ?>
                        </div>
                        <div class="cuerpo-seccion">
                            <div>
                                <?php
                                    if($accion == 'modificar') echo '<form method="post" action="modificar_tipo.php" enctype="multipart/form-data">';
                                    else echo '<form method="post" action="eliminar_tipo.php">';
                                ?>
                                <input type="hidden" name="id_tipo" <?php echo 'value="' .$tipoEnlace->getId().'"' ?> />
                                <input type="hidden" name="id_usuario" <?php echo 'value="' .$tipoEnlace->getIdUsuario().'"' ?> />
                                <input type="hidden" name="imagen" <?php echo 'value="' .$tipoEnlace->getImagen().'"' ?> />
                                <div style="text-align:center;">
                                    <img height="150px" <?php echo 'src="../../recursos/iconos_tipos_enlaces/' .$tipoEnlace->getImagen().'"'; ?> />
                                </div>
                                <?php
                                    //Se imprime el nombre del enlace
                                    if($accion == "modificar"){
                                        echo '<input type="text" name="nombre" value="'.$tipoEnlace->getNombre().'" />';
                                        echo '<input type="file" name="nueva_imagen" />';
                                        echo '<input type="submit" name="Modificar" value="Modificar">';
                                    }
                                    else{
                                        //Si lo que se hará sera un borrado, se marca el nombre como solo lectura
                                        echo '<input type="text" name="nombre" value="'.$tipoEnlace->getNombre().'" readonly />';
                                        echo '<input type="submit" name="Eliminar" value="Eliminar">';
                                    }
                                ?>
                                <?php echo '</form>'; ?>
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
