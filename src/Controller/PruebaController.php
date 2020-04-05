<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Captcha\CaptchaService;
use App\Service\Session\SessionService;

class PruebaController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function login() {
        return $this->render('login.html.twig');
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logOut() {
        return $this->render('logout.html.twig');
    }


    /**
     * @Route("/sign_in", name="signIn")
     */
    public function signIn(CaptchaService $captchaService, SessionService $sessionService) {
        $captchaService->generarCaptcha();
        $stringCaptcha = $captchaService->getCadenaCaptcha();
        $sessionService->initSession();
        $sessionService->setParameter('signInCaptchaString', $stringCaptcha);
        return $this->render('sign_in.html.twig', [
            'captcha' => $captchaService->getImageJpegBase64()
        ]);
    }


    /**
     *  @Route("/inicio", name="inicio")
     */
    public function inicio() {
        return $this->render('inicio.html.twig');
    }
    
}