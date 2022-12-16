<?php

session_start();

if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Certificates - Admin";
$_SESSION['sub_menu_title'] = "certificates - view";

require_once "../../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("certificates/index.php");