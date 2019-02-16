<?php
    
    require_once 'Enlace.php';
    require_once 'BBDD.php';
    
    /**
     * Clase trabajar con los enlaces en la BBDD
     */
    class BBDDEnlaces extends BBDD{
        
        
        /**
         * Metodo para obtener el enlace cuyo id corresponda con el id recibido como parametro.
         * 
         * Devuelve el enlace (instancia de la clase Enlace) si este se encuentra en la BBDD o null en caso contrario.
         * 
         * @param type $idEnlace
         * @return \Enlace
         */
        public function obtenerEnlace($idEnlace){
            $enlace = null;
            //Se forma la consulta
            $consulta = "SELECT * FROM enlaces WHERE id=$idEnlace";
            //Obtenemos los registros
            $datos = mysqli_query($this->conex,$consulta);
            if(mysqli_num_rows($datos) > 0){
                $reg = mysqli_fetch_array($datos);
                $enlace = new Enlace($reg['id'], $reg['id_usuario'], $reg['url'], $reg['nombre'], $reg['id_tipo']);
            }
            return $enlace;
        }
        
        
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
            $consulta = "SELECT * FROM enlaces WHERE id_usuario=$idUser AND id_tipo LIKE '$interes' ORDER BY nombre ASC";
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
         * Devuelve un mensaje con el resultado de la operacion de insercion
         * 
         * @param type $enlace
         * @return string Mensaje con el resultado de la operacion
         */
        public function anadirEnlace($enlace){
            $mensaje = "";
            //Valores del enlace recibido
            $idUsuario = $enlace->getIdUsuario();
            $url = $enlace->getUrl();
            $nombre = $enlace->getNombre();
            $idTipo = $enlace->getIdTipo();
            //Se verifica que no exista ya un enlace con el mismo nombre o url en la misma catergoria para el usuario
            $consulta = "SELECT * FROM enlaces WHERE (url='$url' OR nombre='$nombre') AND id_usuario=$idUsuario AND id_tipo=$idTipo";
            $datos = mysqli_query($this->conex, $consulta);
            if(mysqli_num_rows($datos) < 1){
                //Se forma la consulta de insercion
                $consulta = "INSERT INTO enlaces (id_usuario, url, nombre, id_tipo) VALUES ($idUsuario, '$url', '$nombre', $idTipo)";
                $datos = mysqli_query($this->conex, $consulta);
                //Se verifica el numero de registros insertados
                if(mysqli_affected_rows($this->conex) == 1){
                    $mensaje = '<p class="mensaje-exito">Enlace añadido correctamente</p>';
                }
                else{
                    $mensaje = '<p class="mensaje-error">No se pudo añadir el enlace</p>';
                }
            }
            else{
                $mensaje = '<p class="mensaje-error">No se puede añadir un enlace con la misma direccion o nombre en la misma categoria</p>';
            }
            return $mensaje;
        }
         
        
       /**
        * Metodo para modificar un enlace de la BBDD (el recibido como parametro).
        * 
        * Devuelve un mensaje con el resultado de la operacion
        * 
        * @param type $enlace
        * @return string Mensaje con el resultado de la operacion
        */
        public function modificarEnlace($enlace){
            $mensaje = "";
            //Valores del enlace recibido
            $idUsuario = $enlace->getIdUsuario();
            $idEnlace = $enlace->getId();
            $url = $enlace->getUrl();
            $nombre = $enlace->getNombre();
            $idTipo = $enlace->getIdTipo();
            //Se verifica que no exista ya un enlace con el mismo nombre o url en la misma catergoria para el usuario
            $consulta = "SELECT * FROM enlaces WHERE url='$url' AND nombre='$nombre' AND id_usuario=$idUsuario AND id_tipo=$idTipo";
            $datos = mysqli_query($this->conex, $consulta);
            if(mysqli_num_rows($datos) < 1){
                //Se forma la consulta
                $consulta = "UPDATE enlaces SET url='$url', nombre='$nombre', id_tipo=$idTipo WHERE id=$idEnlace";
                $datos = mysqli_query($this->conex, $consulta);
                //Se verifica el numero de registros insertados
                if(mysqli_affected_rows($this->conex) == 1){
                    $mensaje = '<p class="mensaje-exito">Enlace modificado correctamente</p>';
                }
                else{
                    $mensaje = '<p class="mensaje-error">No se pudo modificar el enlace</p>';
                }
            }
            else{
                $mensaje = '<p class="mensaje-error">Los valores indicados ya coinciden con los de otro enlace con la misma direccion o nombre en este categoria</p>';
            }
            return $mensaje;
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

