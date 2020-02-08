<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PruebaController extends AbstractController
{


    /**
     * @Route("/login", name="login")
     */
    public function login(){
        return $this->render('login.html.twig');
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logOut(){
        return $this->render('logout.html.twig');
    }


    /**
     * @Route("/sign_in", name="signIn")
     */
    public function signIn(){
        return $this->render('sign_in.html.twig');
    }


    /**
     *  @Route("/inicio", name="inicio")
     */
    public function inicio(){
        return $this->render('inicio.html.twig');
    }
    
}