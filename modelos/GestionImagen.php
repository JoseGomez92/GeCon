<?php

    class GestionImagen{
        
        //Atributos
        private static $iconoPorDefecto = 'default.png';
        private static $dirImagenes = '../../recursos/iconos_tipos_enlaces/';
        
        
        public static function obtenerExtension($fileImagen){
            $infoFichero = new SplFileInfo($fileImagen['name']);
            $extension = $infoFichero->getExtension();
            return $extension;
        }
        
        /**
         * Metodo para comprobar que el tipo de fichero recibido es una imagen
         * con extension JPEG o PNG.
         * 
         * @param type $fileImagen
         * @return type
         */
        public static function comprobarExtensionImagen($fileImagen){
            $c = false;
            //Se obtiene la extension del fichero
            $extension = strtolower(self::obtenerExtension($fileImagen));
            if($extension == 'jpg' || $extension == 'png') $c = true;
            return $c;
        }
        
        
        /**
         * Metodo para copiar la imagen recibida al directorio que almacenará las imagenes.
         * La imagen será renombrada como idUsuario_NombreInteres.extension (ejemplo: 8_Musica.png).
         * 
         * @param type $fileImagen
         * @param type $idUser
         * @param type $nombreInteres
         */
        public static function subirImagen($fileImagen, $idUser, $nombreInteres){
            //Copiamos el valor del fichero temporal al definitivo
            copy($fileImagen['tmp_name'], $fileImagen['name']);
            //Se obtiene la extension del fichero
            $extension = self::obtenerExtension($fileImagen);
            //Se forma la cadena con el path y nuevo nombre del fichero
            $nomDef = $idUser.'_'.$nombreInteres.'.'.$extension;
            $path = self::$dirImagenes.$nomDef;
            //Movemos el fichero al directorio indicado
            rename($fileImagen['name'], $path);
            //Se devuelve el nombre de la imagen
            return $nomDef;
        }
        
        
        /**
         * Metodo para poner la imagen por defecto (default.png) al nuevo interes añadido por el usuario.
         * 
         * @param type $idUser
         * @param type $nombreInteres
         */
        public static function subirImagenPorDefecto($idUser, $nombreInteres){
            //Se forma la cadena con el path y nuevo nombre del fichero
            $nomDef = $idUser.'_'.$nombreInteres.'.png';
            $path = self::$dirImagenes.$nomDef;
            //Se copia la imagen por defecto y se le da el nombre para el tipo de interes
            copy(self::$dirImagenes.self::$iconoPorDefecto, $path);
            //Se devuelve el nombre de la imagen
            return $nomDef;
        }
        
        
        /**
         * Metodo para eliminar la imagen que recibe el metodo del directorio
         * de iconos (imagenes) para los tipos.
         * 
         * @param type $nombreImagen
         * @return type
         */
        public static function eliminarImagen($nombreImagen){
            return unlink(self::$dirImagenes.$nombreImagen);
        }
        
    }

?>

