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
    $mensaje = "";
    //Bloque para modificar los datos del tipo de enlace
    if(isset($_POST['id_tipo'])){
        //Se recuperan los datos del tipo de enlace
        $idTipo = $_POST['id_tipo'];
        $idUsuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        //Se crea el tipo de enlace
        $tipoEnlace = new TipoEnlace($idTipo, $idUsuario, $nombre);
        //Se recupera la instancia del enlace de la BBDD
        $bbdd = new BBDDTiposEnlace();
        if($bbdd->modificarTipoEnlace($tipoEnlace)){
            $mensaje = "<p>Enlace modificado correctamente.</p>";
        }
        else{
            $mensaje = "<p>Error. No se pudo modificar el Tipo de Enlace.</p>";
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
        <title>GeCon - Modificacion de Tipos de Enlaces</title>
    </head>
    <body>
        <div
            <div>
                <h2>Modificación de Tipo de Enlace</h2>
            </div>
            <div>
                <?php if(isset($mensaje)) echo $mensaje; ?>
            </div>
            <div>
                <a href="gestionar_tipos.php">Volver</a>
            </div>
        </div>
    </body>
</html>
