<?php

namespace App\Service;

use App\Utils\Captcha\CaptchaGenerator;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;


class Captcha {

    /**
     * Devuelve la imagen JPEG correspondiente al Captcha codificada en base 64.
     */
    public function getCaptchaJpegBase64($cantidadCaracteres = 8) : string {
        $metaDatosHtml = 'data:image/jpeg;base64,';
        $captchaGenerator = new CaptchaGenerator($cantidadCaracteres);
        $captchaResource = $captchaGenerator->getCaptchaImagen();
        ob_start();
        imagejpeg($captchaResource);
        $captchaImagen = ob_get_clean();
        $imagenBase64 = base64_encode($captchaImagen);

        return $metaDatosHtml.$imagenBase64;
    }


    /**
     * Devuelve la imagen JPEG correspondiente al Captcha codificada en base 64.
     */
    public function getCaptchaPngBase64($cantidadCaracteres = 8) : string {
        $metaDatosHtml = 'data:image/png;base64,';
        $captchaGenerator = new CaptchaGenerator($cantidadCaracteres);
        $captchaResource = $captchaGenerator->getCaptchaImagen();
        ob_start();
        imagepng($captchaResource);
        $captchaImagen = ob_get_clean();
        $imagenBase64 = base64_encode($captchaImagen);

        return $metaDatosHtml.$imagenBase64;
    }

}