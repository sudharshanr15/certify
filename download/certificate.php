<?php

session_start();

require_once "./../vendor/autoload.php";

(new \Certify\Certify\core\View)->render("download/certificate.php");