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
    $idTipo = "";
    $idUsuario = $_SESSION['id_user'];
    //Bloque para obtener los enlaces del usuario
    if(isset($_GET['tipo'])){
        $idTipo = $_GET['tipo'];
        $bbddEnlaces = new BBDDEnlaces();
        $arrayEnlaces = $bbddEnlaces->obtenerEnlaces($idUsuario, $idTipo);
        //Se recupera la instancia del tipo de enlace de la BBDD
        $bbdd = new BBDDTiposEnlace();
        $tipoEnlace = $bbdd->obtenerTipoEnlace($idTipo);
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
        <title>GeCon - Ver Enlaces de un Tipo</title>
    </head>
    <body>
        <div>
            <div>
                <h4><?php echo $tipoEnlace->getNombre(); ?></h4>
            </div>
            <div>
                <div>
                    <?php
                        if(count($arrayEnlaces) > 0){
                            //Se muestran los enlaces
                            foreach ($arrayEnlaces as $enlace){
                                echo '<div>';
                                echo '<a href="'.$enlace->getUrl().'" target="blank">';
                                //Se imprime el favicon del sitio
                                echo '<span><img width="32px" src="http://www.google.com/s2/favicons?domain='.$enlace->getUrl().'" alt="favicon"></span>';
                                //Se imprime el nombre que el usuario le ha dado al enlace
                                echo '<span>'.$enlace->getNombre().'</span>';
                                echo '</a>';
                                echo '</div>';
                            }
                        }
                        else{
                            echo '<p>Aún no ha añadido ningún enlace de este tipo.</p>';
                            echo '<a href="getionar_enlaces">Añadir enlaces</a>';
                        }                 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
