<?php
    
    require_once 'TipoEnlace.php';
    require_once 'BBDD.php';
    
    /**
     * Clase trabajar con los tipos de enlaces en la BBDD.
     */
    class BBDDTiposEnlace extends BBDD{        
        
        /**
         * Metodo para obtener la instancia del enlace correspondiente al valor del id recibido.
         * 
         * Devuelve la instancia si esta existe en la BBDD o null en caso contrario.
         * 
         * @param type $idTipo
         * @return \TipoEnlace
         */
        public function obtenerTipoEnlace($idTipo){
            $tipoEnlace = null;
            //Se forma la consulta
            $consulta = "SELECT * FROM tipos_enlace WHERE id=$idTipo";
            //Obtenemos los registros
            $datos = mysqli_query($this->conex,$consulta);
            if(mysqli_num_rows($datos) > 0){
                $reg = mysqli_fetch_array($datos);
                $tipoEnlace = new TipoEnlace($reg['id'], $reg['id_usuario'], $reg['nombre'], $reg['imagen']);                 
            }
            return $tipoEnlace;
        }
        
        
        /**
         * Metodo para obtener un array con los tipos de interes (tipos de enlaces) introducidos por el usuario.
         * 
         * @param type $idUser
         */
        public function obtenerTiposEnlace($idUser){
            //Array donde se volcarán los enlaces
            $arrayTiposEnlace = array();
            $consulta = "SELECT * FROM tipos_enlace WHERE id_usuario=$idUser ORDER BY nombre ASC";
            //Obtenemos los registros
            $datos = mysqli_query($this->conex,$consulta);
            if(mysqli_num_rows($datos) > 0){
                while($reg = mysqli_fetch_array($datos)){
                    $tipoEnlace = new TipoEnlace($reg['id'], $reg['id_usuario'], $reg['nombre'], $reg['imagen']);
                    //Se añaden nombre del enlace y la url al array asociativo de valores
                    $arrayTiposEnlace[] = $tipoEnlace;
                }   
            }
            return $arrayTiposEnlace;
        }
         
        
        /**
         * Metodo para añadir un tipo de enlace a la base de datos.
         * 
         * Devuelve true si el tipo de enlace se ha añadido y false en caso contrario.
         * 
         * @param type $enlace
         */
        public function anadirTipoEnlace($tipoEnlace){
            $c = false;
            //Valores del enlace recibido
            $idUsuario = $tipoEnlace->getIdUsuario();
            $nombre = $tipoEnlace->getNombre();
            $imagen = $tipoEnlace->getImagen();
            //Se forma la consulta
            $consulta = "INSERT INTO tipos_enlace (id_usuario, nombre, imagen) VALUES ($idUsuario, '$nombre', '$imagen')";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
         
        
        /**
         * Metodo para modificar un tipo de enlace de la BBDD cuyo id sea el del tipo de enlace recibido como
         * parametro (el id no se modificará, si el resto de campos).
         * 
         * Devuelve true si el enlace se ha modificado y false en caso contrario.
         * 
         * @param type $enlace
         * @return boolean
         */
        public function modificarTipoEnlace($tipoEnlace){
            $c = false;
            //Valores del enlace recibido
            $id = $tipoEnlace->getId();
            $idUsuario = $tipoEnlace->getIdUsuario();
            $nombre = $tipoEnlace->getNombre();
            $imagen = $tipoEnlace->getImagen();
            //Se forma la consulta
            $consulta = "UPDATE tipos_enlace SET nombre='$nombre', imagen='$imagen' WHERE id=$id";
            echo $consulta;
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
        
        
        /**
         * Metodo para eliminar el tipo de enlace de la BBDD que coincida con el del
         * tipo de enlace recibido como parametro del metodo.
         * 
         * Devuelve true si el tipo de enlace se borra y false en caso contrario.
         * 
         * @param type $enlace
         * @return boolean
         */
        public function eliminarTipoEnlace($tipoEnlace){
            $c = false;
            //ID del tipo enlace a recibido (el cual se borrará)
            $id = $tipoEnlace->getId();
            //Se forma la consulta para borrar todos los enlaces del tipo
            $consulta = "DELETE FROM enlaces WHERE id_tipo=$id";
            //Se eliminan los enlaces
            $datos = mysqli_query($this->conex, $consulta);
            //Se forma la consulta para borrar el tipo
            $consulta = "DELETE FROM tipos_enlace WHERE id=$id";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros eliminados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
         
     }

?>

