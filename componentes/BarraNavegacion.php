<?php

    class BarraNavegacion{
        
        //Atributos
        private static $uriPrincipal = '/GeCon/vistas/';             
        private static $items = array(
            'Mis Enlaces' => 'enlaces/ver_tipos_enlaces.php',
            'Gestionar Enlaces' => 'enlaces/gestionar_enlaces.php',
            'Gestionar Categorias' => 'tipos/gestionar_tipos.php',
            'Salir' => 'salir.php');
        
        
        /**
         * Metodo para obtener la seccion en la que se encuentra el usuario navegando.
         * 
         * @return string seccion en la que se encuentra el usuario.
         */
        public static function obtenerSeccionActual(){
            $seccionActual = "";
            //Se obtiene la URI
            $uri = $_SERVER['PHP_SELF'];
            //Se obtiene la seccion actual
            if(stripos($uri, 'ver_tipos_enlaces')) $seccionActual = 'Mis Enlaces';
            else if(stripos($uri, 'enlaces')) $seccionActual = 'Gestionar Enlaces';
            else if(stripos($uri, 'tipos')) $seccionActual = 'Gestionar Categorias';
            return $seccionActual;
        }
        
        /**
         * Metodo para crear el menu de navegación de la pagina.
         * 
         * @return string Devuelve el codigo HTML correspondiente a la barra de navegacion.
         */
        public static function crearMenu(){
            //Se obtiene la seccion actual
            $seccionActual = self::obtenerSeccionActual();
            $cod = '<nav><ul class="lista-items-nav">';
            foreach(self::$items as $key => $val){
                if($seccionActual == $key){
                    $cod .= '<li class="item-nav"><a class="enlace-nav border-bot" href="'.self::$uriPrincipal.$val.'">'.$key.'</a></li>';
                }
                else $cod .= '<li class="item-nav"><a class="enlace-nav" href="'.self::$uriPrincipal.$val.'">'.$key.'</a></li>';
            }
            $cod .= '</ul></nav>';
            return $cod;
        }
        
    }

?>