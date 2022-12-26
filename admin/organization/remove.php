<?php

session_start();

if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Organization - Admin";
$_SESSION['sub_menu_title'] = "organization - view";

require_once "../../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("organization/remove.php");