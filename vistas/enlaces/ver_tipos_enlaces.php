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
        <script type="text/javascript" src="../../js/redireccionar.js"></script>
    </head>
    <body>
        <div>
            <div>
                <?php echo BarraNavegacion::crearMenu(); ?>
            </div>
            <div>
                <h2>¿Que quiero ver?</h2>
            </div>
            <div>
                <?php
                    //Se muestran los tipos de enlace del usuario
                    if(count($arrayTipos) > 0){
                        echo '<table><tr>';
                            foreach($arrayTipos as $tipo){    
                                echo '<td>';
                                echo '<a href="ver_enlaces_por_tipo.php?tipo='.$tipo->getId().'">',
                                        '<img height="100px" src="../../recursos/iconos_tipos_enlaces/'.$tipo->getImagen().'" alt="'.$tipo->getImagen().'">',
                                        '<p>'.$tipo->getNombre().'</p>',
                                '</a>';
                                echo '</td>';
                            }
                        echo '</table></tr>';
                    }
                    else{
                        echo '<p>¡Vaya! Aún no hay ningún Tipo de enlace para poder ver.</p>';
                        echo '<a href="gestionar_enlaces.php">Añadir un enlace</a>';
                    }
                ?>
            </div>
        </div>
    </body>
</html>
