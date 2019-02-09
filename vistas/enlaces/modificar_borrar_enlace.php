<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlaces.php';
    require_once '../../modelos/TipoEnlace.php';
    require_once '../../modelos/BBDDTiposEnlace.php';
    require_once '../../componentes/BarraNavegacion.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
    //Bloque para recuperar los datos del enlace y los tipos de enlace
    $idUsuario = $_SESSION['id_user'];
    $idEnlace = -1;
    $enlace = null;
    $accion = "modificar";
    //Se verifica que se haya recibido el id del enlace
    if(isset($_POST['id_enlace'])){
        $idEnlace = $_POST['id_enlace'];
        //Se verifica el tipo de accion a realizar
        if(isset($_POST['eliminar'])) $accion = "eliminar";
        //Se recupera la instancia del enlace de la BBDD
        $bbddEnlaces = new BBDDEnlaces();
        $enlace = $bbddEnlaces->obtenerEnlace($idEnlace);
        //Se recuperan los tipos de enlace del usuario
        $bbddTipos = new BBDDTiposEnlace();
        $arrayTipos = $bbddTipos->obtenerTiposEnlace($idUsuario);
    }
    else{
        //Se redirige a la pagina de gestion de enlaces
        header('Location: gestionar_enlaces.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Modificar o Borrar Enlaces</title>
        <script type="text/javascript" src="../../js/redireccionar.js"></script>
    </head>
    <body>
        <div>
            <div>
                <?php echo BarraNavegacion::crearMenu(); ?>
            </div>
            <div>
                <?php
                    if($accion == 'modificar') echo '<h2>Modificar Enlace</h2>';
                    else echo '<h2>Eliminar Enlace</h2>';
                ?>
            </div>
            <div>
                <?php
                    if($accion == 'modificar') echo '<form method="post" action="modificar_enlace.php">';
                    else echo '<form method="post" action="eliminar_enlace.php">';
                ?>
                    <input type="hidden" name="id_enlace" <?php echo 'value="'.$enlace->getId().'"' ?> />
                    <input type="hidden" name="id_usuario" <?php echo 'value="'.$enlace->getIdUsuario().'"'; ?> />
                    <?php
                        //Se imprime el nombre del enlace
                        if($accion == "modificar"){
                            echo '<input type="url" name="url" value="'.$enlace->getUrl().'" required />';
                            echo '<input type="text" name="nombre" value="'.$enlace->getNombre().'" required />';
                            echo '<select name="id_tipo">';
                                //Se imprimen los tipos de enlace del usuario
                                foreach($arrayTipos as $tipoEnlace){
                                    if($tipoEnlace->getId() == $enlace->getIdTipo()){
                                        echo '<option value="'.$tipoEnlace->getId().'" selected>'.$tipoEnlace->getNombre().'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$tipoEnlace->getId().'">'.$tipoEnlace->getNombre().'</option>';
                                    }
                                }
                            echo '</select>';
                            echo '<input type="submit" name="Modificar" value="Modificar">';
                        }
                        else{
                            echo '<input type="hidden" name="id_tipo" value="'.$enlace->getIdTipo().'" />';
                            //Si lo que se hará sera un borrado, se marcan los campos como solo lectura
                            foreach($arrayTipos as $tipoEnlace){
                                if($tipoEnlace->getId() == $enlace->getIdTipo()){
                                    echo '<p>'.$tipoEnlace->getNombre().'</p>';
                                }
                            }
                            echo '<input type="url" name="url" value="'.$enlace->getUrl().'" readonly />';
                            echo '<input type="text" name="nombre" value="'.$enlace->getNombre().'" readonly />';
                            echo '<input type="submit" name="Eliminar" value="Eliminar">';
                        }
                    ?>
                </form>
            </div>
            <div>
                <iframe <?php echo 'src="'.$enlace->getUrl().'"' ?>></iframe>
                <a <?php echo 'href="'.$enlace->getUrl().'"' ?> target="blank">Ver en la Web</a>
            </div>
        </div>
    </body>
</html>
