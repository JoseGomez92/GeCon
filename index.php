<?php
    //Se verifica si se ha recibo el formulario
    if(isset($_POST['log'])){
        include_once 'modelos/bbdd/BBDDLog.php';
        //Se verifica que los credenciales sean correctos
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $bd = new BBDDLog();
        if(($id = $bd->comprobarLog($user, $pass)) != -1){
            //Se inicia session
            session_start();
            //Se guarda el id del usuario en la variable de session
            $_SESSION['id_user'] = $id;
            //Se redirige al menu
            header('Location: vistas/menu.php');
        }
        else{
            $mensaje = '<p>Credenciales incorrectos</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Login</title>
    </head>
    <body>
        <div>
            <div>
                <h2>Gecon</h2>
            </div>
            <div>
                <?php
                    if(isset($mensaje)) echo $mensaje;
                ?>
            </div>
            <div>
                <form method="post">
                    <div>
                        <input type="text" name="user" placeholder="Usuario" required />
                        <input type="password" name="pass" placeholder="Contraseña" required />
                        <input type="submit" value="Logear" name="log" />
                    </div>
                </form>
            </div>
            <div>
                <a href="vistas/nuevo_usuario.php">Aún no estoy registrado y quiero registrarme</a>
            </div>
        </div>
    </body>
</html>
