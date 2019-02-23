<?php

    /**
     * Funcion remplazar caracteres de la cadena recibida como argumento.
     * 
     * Devuelve dicha cadena sin los acentos, .
     * 
     * @param type $cadena
     */
    function remplazarCaracteres($cadena){      
        //Se eliminan los acentos en la á, Á...
        $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena);
        //Se eliminan los acentos en la é, É...
        $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena);
        //Se eliminan los acentos en la í, Í...
        $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena);
        //Se eliminan los acentos en la ó, Ó...
        $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena);
        //Se eliminan los acentos en la ú, Ú...
        $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena);
        //Se eliminan las eñes y ç
        $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena);
        //Se eliminan los acentos y simbolos
        $cadena = str_replace(
        array('´','\'', '^', '$', '#', '@'),
        array('', '', '', '', '', 'a'),
        $cadena);
        return $cadena;
    }
    
    
    /**
     * Función para eliminar los espacios en blanco de la cadena recibida como parametro.
     * 
     * Devuelve la cadena recibida sin espacios
     * 
     * @param type $cadea
     * @return type
     */
    function reemplazarEspacios($cadena){
        //Se eliminan los espacios en la cadena
        $cadena = str_replace(array(' '), array(''), $cadena);
        return $cadena;
    }

?>
