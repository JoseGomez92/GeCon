<?php
    session_start();
    //Destruir todas las variables de sesión.
    $_SESSION = array();
    setcookie(session_name(), '', time() - 99999, '/');
    //Finalmente, destruir la sesión.
    session_destroy();
    //Se redirige a la pagina de logueo (index.php)
    header('Location: ../index.php');
?>