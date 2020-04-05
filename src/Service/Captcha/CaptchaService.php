<?php

namespace App\Service\Captcha;

use App\Service\Captcha\CaptchaConfiguration;
use App\Service\Captcha\CaptchaGenerator;


class CaptchaService {

    private static $configuracion;


    public function generarCaptcha() {
        self::$configuracion = new CaptchaConfiguration();
    }


    public function getCadenaCaptcha() : string {
        return self::$configuracion->getCadenaCaracteres();
    }
    

    public function getTamanioCaptcha(CaptchaConfiguration $configuracion) : array {
        return array('alto' => $configuracion->getAlto(), 'ancho' => $configuracion->getAncho());
    }


    /**
     * Devuelve un ImageString JPEG codificada en Base64
     */
    public function getImageJpegBase64() : string {
        $metaDatosHtml = 'data:image/jpeg;base64,';
        $imagenBase64 = $this->getImageCaptcha('JPEG');

        return $metaDatosHtml.$imagenBase64;
    }


    /**
     * Devuelve un ImageString PNG codificada en Base64
     */
    public function getImagePngBase64() : string {
        $metaDatosHtml = 'data:image/png;base64,';
        $imagenBase64 = $this->getImageCaptcha('PNG');

        return $metaDatosHtml.$imagenBase64;
    }


    /**
     * Genera una imagen 
     */
    private function getImageCaptcha(string $imagenFormat) : string {
        $captchaGenerator = new CaptchaGenerator(self::$configuracion);
        $imageResource = $captchaGenerator->generarImagen();
        ob_start();
        ($imagenFormat === 'JPEG')? imagejpeg($imageResource) : imagepng($imageResource);
        $captchaImagen = ob_get_clean();
        $imagenBase64 = base64_encode($captchaImagen);

        return $imagenBase64;
    } 

}