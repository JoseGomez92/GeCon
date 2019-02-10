<?php
    require_once '../modelos/BBDDLog.php';
?>
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
            //Se crea la instancia de la BBDD
            $bd = new BBDDLog();
            //Se registra el usuario
            if($bd->crearUser($user, $mail, $pass1)){
                $mensaje = '<p class="mensaje-exito">Se ha registrado correctamente</p>';
            }
            else{
                $mensaje = '<p class="mensaje-error">No ha podido registrarse. Ya existe un usuario con los mismos credenciales.</p>';
            }
        }
        else{
            $mensaje = '<p class="mensaje-error">Las constraseñas indicadas no coinciden.</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Nuevo usuario</title>
		<link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../css/reset.css">
        <link type="text/css" rel="stylesheet" href="../css/styles.css">
        <link type="text/css" rel="stylesheet" href="../css/index.css">
    </head>
    <body>
        <div class="contenedor-body">
			<section>
				<div class="contenedor-section">
					<div class="contenedor-seccion-principal">
            			<div class="cabecera-seccion">
							<h3>Gecon</h3>
						</div>
						<div class="cuerpo-seccion">
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
					</div>
				</div>
			</section>
        </div>
    </body>
</html>
