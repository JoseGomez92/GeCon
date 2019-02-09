<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    $idUsuario = $_SESSION['id_user'];
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
        if($bbdd->anadirEnlace($enlace)){
            $mensaje = '<p>Enlace añadido correctamente</p>';
        }
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
    </head>
    <body>
        <div>
            <div>
                <?php if(isset($mensaje)) echo $mensaje; ?>
            </div>
            <div>
                <h4>Añadir enlace</h4>
                <?php
                    //Se verifican que existan tipos de enlace para el usuario
                    if(count($arrayTipos) > 0){
                        echo '<form method="post">',
                            '<div>',
                                '<input type="url" name="url" placeholder="Direccion URL" required />',
                                '<input type="text" name="nombre" placeholder="Nombre para el enlace" required />',
                                '<select name="tipo">';
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
                        echo '<p>Añada el un Tipo de Enlace para posteriormente poder añadir los enlaces que desee a este.</p>';
                        echo '<a href="../tipos/gestionar_tipos.php">Añadir Tipo de Enlace</a>';
                    }
                ?>
            </div>
            <div>
                <h4>Gestionar enlaces</h4>
                <div>
                    <?php
                        if(count($arrayEnlaces) > 0){
                            //Se muestran los enlaces y las opciones para modificar y borrar
                            foreach ($arrayEnlaces as $enlace){
                                echo '<form method="post" action="modificar_borrar_enlace.php">',
                                    '<input type="hidden" name="id_enlace" value="'.$enlace->getId().'" />',
                                    '<input type="hidden" name="id_usuaro" value="'.$enlace->getIdUsuario().'" />',
                                    '<p>'.$enlace->getNombre().'</p>',
                                    '<p>'.$enlace->getUrl().'</p>';
                                    //Se busca el tipo de enlace para imprimir este
                                    foreach($arrayTipos as $tipo){
                                        if($enlace->getIdTipo() == $tipo->getId()){
                                            echo '<p>'.$tipo->getNombre().'<p>';
                                        }
                                    }
                                    echo '<input type="submit" name="modificar" value="Modificar" />',
                                    '<input type="submit" name="eliminar" value="Eliminar" />',
                                '</form>';
                            }
                        }
                        else{
                            echo '<p>Aún no ha indicado ningún enlace.</p>';
                        }                 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
