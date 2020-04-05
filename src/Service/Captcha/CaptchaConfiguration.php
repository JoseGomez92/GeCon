<?php

namespace App\Service\Captcha;

class CaptchaConfiguration {

    private $ancho;
    private $alto;
    private $cadenaCaracteres;
    private const CARACTERES_CAPTCHA = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789@#';


    public function getAncho() : int {
        return $this->ancho;
    }


    public function getAlto() : int {
        return $this->alto;
    }


    public function getCadenaCaracteres() : string {
        return $this->cadenaCaracteres;
    }
    

    public function __construct() {
        $this->alto = 50;
        $this->cadenaCaracteres = $this->generateCadenaCaracteres(8);
        $this->ancho = $this->calcularAnchoImagen();
    }


    /**
    * Recibe un entero con el numero de caracteres y devuelve una cadena
    * generada de forma aletoria con la cantidad de caracteres recibida.
    */
    private function generateCadenaCaracteres(int $cantidadCaracteres) : string {
        $cadenaCaracteres = "";
        for($i = 0; $i < $cantidadCaracteres; $i++) {
            $indiceCaracter = rand(0, (strlen(self::CARACTERES_CAPTCHA) - 1));
            $char = self::CARACTERES_CAPTCHA[$indiceCaracter];
            $cadenaCaracteres .= $char;
        }

        return $cadenaCaracteres;
    }


    private function calcularAnchoImagen() : int {
        return ((strlen($this->cadenaCaracteres)) * 15);
    }

}