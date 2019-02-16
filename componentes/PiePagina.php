<?php

    class PiePagina{
        
        //Atributos
        private static $codHtml = 
            '<footer>
                <div class="contenedor-footer">
                    <div class="footer-izq">
                       <h3>gecon<h3>
                    </div>
                    <div class="footer-der">
                        <a href="https://github.com/JoseGomez92">
                            <span>Jose Gomez Gonzalez - 2019</span>
                            <img class="logo-git" src="https://image.flaticon.com/icons/svg/23/23957.svg">
                        </a>
                    </div>
            </footer>';    
        
        
        /**
         * Metodo para obtener el codigo HMTL correspondiente al pie de pagina del sitio web.
         * 
         * @return type
         */
        public static function obtenerPiePagina(){
            return self::$codHtml;
        }
   
    }

?>