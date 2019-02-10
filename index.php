<?php
    require_once 'modelos/BBDDLog.php';
?>
<?php
    //Se verifica si se ha recibo el formulario
    if(isset($_POST['log'])){
        //Se inicia session
        session_start();
        //Se verifica que los credenciales sean correctos
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $captchaUsuario = $_POST['captcha'];
        $captchaGenerado = $_SESSION['captcha_generado'];
        if($captchaUsuario == $captchaGenerado){
            $bd = new BBDDLog();
            if(($id = $bd->comprobarLog($user, $pass)) != -1){
                //Se guarda el id del usuario en la variable de session
                $_SESSION['id_user'] = $id;
                //Se redirige al menu
                header('Location: vistas/enlaces/ver_tipos_enlaces.php');
            }
            else{
                $mensaje = '<p>Credenciales incorrectos</p>';
            }
        }
        else{
            $mensaje = '<p>El captcha que ha indicado es erroneo</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GeCon - Login</title>
        <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/reset.css">
        <link type="text/css" rel="stylesheet" href="css/styles.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <div class="contenedor-body">
            <section>
				<div class="contenedor-section">
					<div class="contenedor-section-principal">
						<div class="section-principal">
							<div class="cabecera-seccion">
								<h3>GeCon</h3>
							</div>
							<?php
								if(isset($mensaje)) echo '<div>'.$mensaje.'</div>';
							?>
							<div class="contenedor-form-acceso">
								<form method="post">
									<input type="text" name="user" placeholder="Usuario" required />
									<input type="password" name="pass" placeholder="Contraseña" required />
									<div>
										<!-- Se introduce el captcha -->
										<image src="captcha/captcha.php" />
										<input type="text" name="captcha" placeholder="Captcha" required />
									</div>
									<input type="submit" value="Logear" name="log" />
								</form>
							</div>
							<div>
								<a href="vistas/nuevo_usuario.php">No estoy registrado. Resgistrarme.</a>
							</div>
						</div>
					</div>
				</div>
			</section>
        </div>
    </body>
</html>
