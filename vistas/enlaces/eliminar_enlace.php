<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../componentes/BarraNavegacion.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $mensaje = "";
    //Bloque para modificar los datos del tipo de enlace
    if(isset($_POST['id_enlace'])){
        //Se recuperan los datos del tipo de enlace
        $idEnlace = $_POST['id_enlace'];
        $idUsuario = $_POST['id_usuario'];
        $url = $_POST['url'];
        $nombre = $_POST['nombre'];
        $idTipo = $_POST['id_tipo'];
        //Se crea el tipo de enlace
        $enlace = new Enlace($idEnlace, $idUsuario, $url, $nombre, $idTipo);
        //Se obtiene la instancia del enlace de la BBDD
        $bbdd = new BBDDEnlaces();
        if($bbdd->eliminarEnlace($enlace)){
            $mensaje = "<p>Enlace eliminado correctamente.</p>";
        }
        else{
            $mensaje = "<p>Error. No se pudo eliminar el Enlace.</p>";
        }
    }
    else{
        //Se redirige a la pagina de gestion de tipos
        header('Location: gestionar_enlaces.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Borrado de Enlaces</title>
        <script type="text/javascript" src="../../js/redireccionar.js"></script>
    </head>
    <body>
        <div>
            <div>
                <?php echo BarraNavegacion::crearMenu(); ?>
            </div>
            <div>
                <h2>Borrado de Enlace</h2>
            </div>
            <div>
                <?php if(isset($mensaje)) echo $mensaje; ?>
            </div>
            <div>
                <a href="gestionar_enlaces.php">Volver</a>
            </div>
        </div>
    </body>
</html>
