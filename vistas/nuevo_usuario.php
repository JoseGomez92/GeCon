<?php
    //Se verifica si se ha recibido el formulario
    if(isset($_POST['registrar'])){
        //Se recogen los datos del formulario
        $user = $_POST['user'];
        $mail = $_POST['mail'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        //Se verifica que las contraseñas recibidas sean iguales
        if($pass1 == $pass2){
            include '../modelos/bbdd/BBDDLog.php';
            //Se crea la instancia de la BBDD
            $bd = new BBDDLog();
            //Se registra el usuario
            if($bd->crearUser($user, $mail, $pass1)){
                $mensaje = '<p>Se ha registrado correctamente</p>';
            }
            else{
                $mensaje = '<p>No ha podido registrarse. Ya existe un usuario con los mismos credenciales.</p>';
            }
        }
        else{
            $mensaje = '<p>Las constraseñas indicadas no coinciden.</p>';
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
                        <input type="text" name="user" placeholder="Usuario" <?php if(isset($user)) echo 'value="'.$user.'"' ?> required />
                        <input type="text" name="mail" placeholder="Correo" <?php if(isset($mail)) echo 'value="'.$mail.'"' ?> required />
                        <input type="password" name="pass1" placeholder="Contraseña" required />
                        <input type="password" name="pass2" placeholder="Repita la contraseña" required />
                        <input type="submit" value="Registrarme" name="registrar" />
                    </div>
                </form>
            </div>
            <div>
                <a href="../index.php">Volver</a>
            </div>
        </div>
    </body>
</html>
