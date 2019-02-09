<?php
    session_start();
    //Medidas de la imagen
    $ancho = 100;
    $alto = 50;
    //Creamos el rectangulo
    $imagen = imageCreate($ancho, $alto);
    //Variables para establecer los colores aleatorios de fondo y texto
    $colorFondo = ImageColorAllocate($imagen, 255,255,255);
    $colorTexto = ImageColorAllocate($imagen, 0, 0, 0);
    $colorLineas = ImageColorAllocate($imagen, rand(0,255), rand(0, 255), rand(0, 255));
    //Rellenamos el rectangulo con el color generado
    imagefilledrectangle ($imagen, 0, 0, $ancho, $alto, $colorFondo);
    //Array para guardar los caracteres que podran aparecer en la imagen
    $caracteres = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w',
    'x','y','z','0','1','2','3','4','5','6','7','8','9','@','#'];
    //Formamos una cadena con una cantidad aleatoria de caracteres (entre 5 y 7) con caracteres aletatorios
    $numCar = rand(5,7);
    $cadena = "";
    for($i = 0; $i < $numCar; $i++){
        $car = $caracteres[rand(0, (count($caracteres) - 1))];
        $cadena .= $car;
    }
    //Introducimos la cadena en la imagen
    ImageString($imagen, 5, 20, 15, $cadena, $colorTexto);
    //Pintamos las lineas para dificultar la lectura por bots
    for($i = 0; $i <= (rand(5, 12)); $i++){
        $x1=rand(0,$ancho);
        $y1=rand(0,$alto);
        $x2=rand(0,$ancho);
        $y2=rand(0,$alto);
        ImageLine($imagen, $x1, $y1, $x2, $y2, $colorLineas);
    }
    //Se almacena la cadena en la variable de session
    $_SESSION['captcha_generado'] = $cadena;
    //Indicamos al navegador que recibirá una imagen JPEG
    Header("Content-type: image/jpeg");
    imagejpeg($imagen);
    //Liberemas los recursos en el server para crear la imagen
    imagedestroy($imagen);
?>

