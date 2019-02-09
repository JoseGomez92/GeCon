<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/TipoEnlace.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
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
        //Se recupera la instancia del enlace de la BBDD
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
        <title>GeCon - Modificar o Borrar Tipos de Enlaces</title>
    </head>
    <body>
        <div>
            <div>
                <?php
                    if($accion == 'modificar') echo '<h2>Modificar Tipo de Enlace</h2>';
                    else echo '<h2>Eliminar Tipo de Enlace</h2>';
                ?>
            </div>
            <div>
                <?php
                    if($accion == 'modificar') echo '<form method="post" action="modificar_tipo.php" enctype="multipart/form-data">';
                    else echo '<form method="post" action="eliminar_tipo.php">';
                ?>
                    <input type="hidden" name="id_tipo" <?php echo 'value="'.$tipoEnlace->getId().'"' ?> />
                    <input type="hidden" name="id_usuario" <?php echo 'value="'.$tipoEnlace->getIdUsuario().'"' ?> />
                    <input type="hidden" name="imagen" <?php echo 'value="'.$tipoEnlace->getImagen().'"' ?> />
                    <div>
                        <img width="100px" <?php echo 'src="../../recursos/iconos_tipos_enlaces/'.$tipoEnlace->getImagen().'">' ?>
                    <div>
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
                </form>
            </div>
        </div>
    </body>
</html>
