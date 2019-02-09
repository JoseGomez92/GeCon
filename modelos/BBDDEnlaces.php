<?php
    
    require_once 'Enlace.php';
    require_once 'BBDD.php';
    
    /**
     * Clase trabajar con los enlaces en la BBDD
     */
    class BBDDEnlaces extends BBDD{
         
        /**
         * Metodo para obtener un array de instancias (objetos) de tipo enlace con los enlaces del usuario 
         * en base al tipo de interes indicado o todos (si no se indica ningun tipo concreto).
         * 
         * @param type $idUser
         * @param type $interes
         */
        public function obtenerEnlaces($idUser, $interes){
            //Array donde se volcarán los enlaces
            $arrayEnlaces = array();
            $consulta = "SELECT * FROM enlaces WHERE id_usuario=$idUser AND id_tipo LIKE '$interes'";
            //Obtenemos los registros
            $datos = mysqli_query($this->conex,$consulta);
            if(mysqli_num_rows($datos) > 0){
                while($reg = mysqli_fetch_array($datos)){
                    $enlace = new Enlace($reg['id'], $reg['id_usuario'], $reg['url'], $reg['nombre'], $reg['id_tipo']);
                    //Se añaden nombre del enlace y la url al array asociativo de valores
                    $arrayEnlaces[] = $enlace;
                }   
            }
            return $arrayEnlaces;
        }
         
        
        /**
         * Metodo para añadir un enlace a la base de datos.
         * 
         * Devuelve true si el enlace se ha añadido y false en caso contrario.
         * 
         * @param type $enlace
         */
        public function anadirEnlace($enlace){
            $c = false;
            //Valores del enlace recibido
            $idUsuario = $enlace->getIdUsuario();
            $url = $enlace->getUrl();
            $nombre = $enlace->getNombre();
            $idTipo = $enlace->getIdTipo();
            //Se forma la consulta
            $consulta = "INSERT INTO enlaces (id_usuario, url, nombre, id_tipo) VALUES ($idUsuario, '$url', '$nombre', $idTipo)";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
         
        
        /**
         * Metodo para modificar un enlace de la BBDD (el recibido como parametro).
         * 
         * Devuelve true si el enlace se ha modificado y false en caso contrario.
         * 
         * @param type $enlace
         * @return boolean
         */
        public function modificarEnlace($enlace){
            $c = false;
            //Valores del enlace recibido
            $idEnlace = $enlace->getId();
            $idUsuario = $enlace->getIdUsuario();
            $url = $enlace->getUrl();
            $nombre = $enlace->getNombre();
            $idTipo = $enlace->getIdTipo();
            //Se forma la consulta
            $consulta = "UPDATE enlaces SET id_usuaurio=$idUsuario, url='$url', nombre='$nombre', id_tipo=$idTipo WHERE id=$idEnlace";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
        
        
        /**
         * Metodo para eliminar el enlace de la BBDD que coincida con el del
         * enlace recibido como parametro del metodo.
         * 
         * Devuelve true si el enlace se borra y false en caso contrario.
         * 
         * @param type $enlace
         * @return boolean
         */
        public function eliminarEnlace($enlace){
            $c = false;
            //ID del enlace a recibido (el cual se borrará)
            $idEnlace = $enlace->getId();
            //Se forma la consulta
            $consulta = "DELETE FROM enlaces WHERE id=$idEnlace";
            $datos = mysqli_query($this->conex, $consulta);
            //Se verifica el numero de registros insertados
            if(mysqli_affected_rows($this->conex) == 1){
                $c = true;
            }
            return $c;
        }
         
     }

?>

