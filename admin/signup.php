<?php

session_start();

require_once "./../vendor/autoload.php";

echo (new \Certify\Certify\core\View)->renderAdmin("signup.php");