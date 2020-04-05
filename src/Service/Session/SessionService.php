<?php

namespace App\Service\Session;

use Symfony\Component\HttpFoundation\Session\Session;

class SessionService {

    private static $session;


    public static function initSession() {
        if(empty(self::$session)) self::$session = new Session();
    }


    public static function setParameter(string $name, $value) {
        self::$session->set($name, $value);
    }

    
    public static function getParameter(string $name) {
        return self::$session->get($name);
    }

}