<?php

namespace App\Service\Captcha;

use App\Service\Captcha\CaptchaConfiguration;

class CaptchaGenerator {

    private $alto;
    private $ancho;
    private $cadenaCaracteres;


    public function __construct(CaptchaConfiguration $configuracion) {
        $this->alto = $configuracion->getAlto();
        $this->ancho = $configuracion->getAncho();
        $this->cadenaCaracteres = $configuracion->getCadenaCaracteres();
    }


    /**
    * Genera la imagen y retorna el contenido del buffer correspondiente a la imagen generada.
    */
    public function generarImagen() {
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