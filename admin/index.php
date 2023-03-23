<?php

session_start();
if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

require_once "./../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("index.php");