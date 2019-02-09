<?php
    require_once '../../funciones/comprobarLog.php';
    require_once '../../modelos/Enlace.php';
    require_once '../../modelos/BBDDEnlace.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(2);
?>
<?php
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
                        <input type="url" name="url" placeholder="Direccion URL" required />
                        <input type="text" name="nombre" placeholder="Nombre para el enlace" required />
                        <select name="tipo">
                            <option value="1">Noticias</option>
                            <option value="2">Deportes</option>
                            <option value="3">Curiosidades</option>
                            <option value="4">Politica</option>
                            <option value="5">Ciencia</option>
                            <option value="6">Cultura</option>
                        </select>
                        <input type="submit" value="Añadir" name="anadir" />
                    </div>
                </form>
            </div>
            <div>
                <h4>Gestionar enlaces</h4>
                <div>
                    <?php
                        //Se obtienen los enlaces de la BBDD
                        
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
