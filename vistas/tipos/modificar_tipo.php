<?php
    require_once '../../funciones/comprobarLog.php';
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
    $mensaje = "";
    //Bloque para modificar los datos del tipo de enlace
    if(isset($_POST['id_tipo'])){
        $c = true;//Variable para controlar la subida de la imagen
        //Se recuperan los datos del tipo de enlace
        $idTipo = $_POST['id_tipo'];
        $idUsuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $imagen = $_POST['imagen'];
        //Se verifica si se ha recibido una imagen para poner esta
        if(isset($_FILES['nueva_imagen']) && $_FILES['nueva_imagen']['name'] != ''){
            //Se verifica que se ha recibido una imagen con extension PNG o JPG
            if(GestionImagen::comprobarExtensionImagen($_FILES['nueva_imagen'])){
                //Se borra la imagen anterior
                if(GestionImagen::eliminarImagen($imagen)){
                    //Se sube la imagen al servidor
                    $imagen = GestionImagen::subirImagen($_FILES['nueva_imagen'], $idUsuario, $nombre);
                    $c = true;
                }
            }
            else{
                $c = false;
            }
        }
        if($c){
             //Se crea el tipo de enlace
            $tipoEnlace = new TipoEnlace($idTipo, $idUsuario, $nombre, $imagen);
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
            $mensaje = "<p>Error. El fichero indicado no es una imagen de tipo JPG o PNG. No se modificó el Tipo de Enlace.</p>";
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
        <script type="text/javascript" src="../../js/redireccionar.js"></script>
    </head>
    <body>
        <div>
            <div>
                <?php echo BarraNavegacion::crearMenu(); ?>
            </div>
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
