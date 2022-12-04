<?php

namespace Certify\Certify\core;

class Router{
    public static function ensureLogin(){
        header("Location: /login.php");
    }
}