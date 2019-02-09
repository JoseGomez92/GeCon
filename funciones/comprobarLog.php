<?php
    /**
     * Funcion para redireccionar a la vista de logueo si el usuario intenta
     * acceder a vistas que requieran de autenticacion.
     * 
     * @param type $nivelProfundidad
     */
    function comprobarLog($nivelProfundidad){
        //Se inicia session
        session_start();
        //Se verifica que exista una variable de session que apunte a un id de usuaro
        if(!isset($_SESSION['id_user'])){
            //Si no existe la variable de session que apunte al id del usuario se redirige a la pagina de logeo(index.php)
            if(!$c){
                switch($nivelProfundidad){
                    case 1:
                        header('Location: ../index.php');
                    break;
                    case 2:
                        header('Location: ../../index.php');
                    break;
                }
            }
        }
    }

?>

