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
    $bbdd = new BBDDTiposEnlace();
    $idUsuario = $_SESSION['id_user'];
    //Se verifica si se ha recibido un nuevo enlace
    if(isset($_POST['anadir'])){;
        $nombre = $_POST['nombre'];
        //Se crea la instancia del tipo de enlace
        $tipoEnlace = new TipoEnlace(null, $idUsuario, $nombre);
        //Se inserta en la BBDD        
        if($bbdd->anadirTipoEnlace($tipoEnlace)){
            $mensaje = '<p>Tipo de enlace añadido correctamente</p>';
        }
        else{
            $mensaje = '<p>Error al añadir el tipo de enlace. Este no se añadió.</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Gestionar Enlaces</title>
    </head>
    <body>
        <div>
            <div>
                <?php if(isset($mensaje)) echo $mensaje; ?>
            </div>
            <div>
                <h4>Añadir enlace</h4>
                <form method="post">
                    <div>
                        <input type="text" name="nombre" placeholder="Nombre para el tipo de enlace" required />
                        <input type="submit" value="Añadir" name="anadir" />
                    </div>
                </form>
            </div>
            <div>
                <h4>Gestionar enlaces</h4>
                <div>
                    <?php
                        //Se obtienen los tipos de enlace de la BBDD
                        $arrayTipos = $bbdd->obtenerTiposEnlace($idUsuario);
                        if(count($arrayTipos) > 0){
                            //Se muestran los tipos de enlace y las opciones para modificar y borrar
                            foreach ($arrayTipos as $tipoEnlace){
                                echo '<form method="post" action="modificar_borrar_tipo.php">',
                                    '<input type="hidden" name="id_tipo" value="'.$tipoEnlace->getId().'" />',
                                    '<p>'.$tipoEnlace->getNombre().'</p>',
                                    '<input type="submit" name="modificar" value="modificar" />',
                                    '<input type="submit" name="eliminar" value="eliminar" />',
                                '</form>';
                            }
                        }
                        else{
                            echo '<p>Aún no ha indicado ningún tipo.Indique una categoria de enlaces para poder añadir estos.</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
