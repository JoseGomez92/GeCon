<?php
    
    include 'BBDD.php';
    /**
     * Clase para comprobar los credenciales de logeo y dar de alta nuevos usuarios en la BBDD
     */
     class BBDDLog extends BBDD{
         
        /**
         * Metodo para comprobar si existe un usuario en la BBDD.
         * 
         * Devuelve el id del usuario si los credenciales son correctos o -1 en caso contrario.
         * @param type $user
         * @param type $pass
         * @return type
         */
        public function comprobarLog($user, $pass){
            $id = -1;
            $consulta = "SELECT id FROM usuarios WHERE usuario='$user' AND contrasenia='$pass'";
            //Obtenemos los registros
            $datos = mysqli_query($this->conex,$consulta);
            if(mysqli_num_rows($datos) > 0){
                $reg = mysqli_fetch_array($datos);
                $id = $reg['id'];
            }
            return $id;
        }
         
        /**
         * Metodo para insertar un nuevo usuario en la BBDD.
         * 
         * Devuelve true si se creo el nuevo usuario y false en caso contrario.
         * 
         * @param type $user
         * @param type $mail
         * @param type $pass
         * @return type
         */
        public function crearUser($user, $mail, $pass){
            $c = false;
            $consulta = "INSERT INTO usuarios (usuario, correo, contrasenia) VALUES ('$user','$mail','$pass')";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
         
     }

?>

