<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PruebaController  extends AbstractController
{

    /**
     * @Route("/inicio", name="inicio")
     */
    public function inicio(){
        return $this->render('principal.html.twig');
    }

    /**
     * @Route("/prueba/{n}", name="prueba")
     */
    public function prueba($n){
        if($n > 7) return new Response('<html><body>Numero: '.$n.'</body></html>');
        else return new Respone('<html><body>El numero debe ser mayor a 7</body></html>');
    }
    
}