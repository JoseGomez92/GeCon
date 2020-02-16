<?php

namespace App\Utils\Captcha;


class CaptchaGenerator {

    private $ancho;
    private $alto;
    private $cadenaCaracteres;
    private $cantidadCaracteres;
    private $captchaImagen;
    private const ALTO = 50;
    private const CARACTERES_CAPTCHA = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789@#';


    public function __construct($cantidadCaracteres){
        $this->cantidadCaracteres = $cantidadCaracteres;
        $this->cadenaCaracteres = $this->generarCadenaCaracteresAleatorio();
        $this->ancho = $this->calcularAnchoImagen();
        $this->alto = self::ALTO;
        $this->captchaImagen = $this->generarImagen();
    }


    public function getAncho() : int {
        return $this->ancho;
    }


    public function getAlto() : int {
        return $this->alto;
    }


    public function getCadenaCaracteres() : string {
        return $this->cadenaCaracteres;
    }


    public function getCantidadCaracteres() : int {
        return $this->cantidadCaracteres;
    }


    public function getCaptchaImagen() {
        return $this->captchaImagen;
    }


    /**
    * Recibe un entero con el numero de caracteres y devuelve una cadena
    * generada de forma aletoria con la cantidad de caracteres recibida.
    */
    private function generarCadenaCaracteresAleatorio() : string {
        $cadenaCaracteres = "";
        for($i = 0; $i < $this->cantidadCaracteres; $i++){
            $indiceCaracter = rand(0, (strlen(self::CARACTERES_CAPTCHA) - 1));
            $char = self::CARACTERES_CAPTCHA[$indiceCaracter];
            $cadenaCaracteres .= $char;
        }

        return $cadenaCaracteres;
    }


    /**
    * Calcula el ancho que debe tener el captcha en base a la cantidad de
    * caracteres que este tendra.
    */
    private function calcularAnchoImagen() : int {
        return ($this->cantidadCaracteres * 15);
    }


    /**
    * Genera la imagen y retorna el contenido del buffer correspondiente a la imagen generada.
    */
    private function generarImagen() {
        $alto = $this->alto;
        $ancho = $this->ancho;
        $cadenaCaracteres = $this->cadenaCaracteres;
        $contenedorImagen = imagecreatetruecolor($ancho, $alto);
        $colorFondo = ImageColorAllocate($contenedorImagen, 255, 255, 255);
        $colorTexto = ImageColorAllocate($contenedorImagen, 0, 0, 0);
        $colorLineas = ImageColorAllocate($contenedorImagen, rand(0,255), rand(0, 255), rand(0, 255));
        imagefilledrectangle ($contenedorImagen, 0, 0, $ancho, $alto, $colorFondo);
        imagestring($contenedorImagen, 5, 20, 15, $cadenaCaracteres, $colorTexto);
        //Se pintan las lineas para dificultar la lectura por bots
        for($i = 0; $i <= (rand(5, 12)); $i++){
            $x0=rand(0, $ancho);
            $y0=rand(0, $alto);
            $x1=rand(0, $ancho);
            $y1=rand(0, $alto);
            imageline($contenedorImagen, $x0, $y0, $x1, $y1, $colorLineas);
        }
        
        return $contenedorImagen;
    }

}