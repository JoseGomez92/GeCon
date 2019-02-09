<?php
    require_once '../funciones/comprobarLog.php';
?>
<?php
    //Se verifica que el usuario este registrado para acceder a la pagina
    comprobarLog(1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Menu</title>
    </head>
    <body>
        <div>
            <div>
                <h2>Gecon</h2>
            </div>
            <div>
                <table>
                    <tr>
                        <td><a href="enlaces/ver_tipos_enlaces.php">Mis enlaces</a></td>
                    </tr>
                    <tr>
                        <td><a href="enlaces/gestionar_enlaces.php">Gestionar mis Enlaces</a></td>
                    </tr>
                    <tr>
                        <td><a href="tipos/gestionar_tipos.php">Gestionar mis Tipos de enlace</a></td>
                    </tr>
                        <td><a href="salir.php">Salir</a></td>
                    </tr>
                </table>
            </div>  
        </div>
    </body>
</html>
