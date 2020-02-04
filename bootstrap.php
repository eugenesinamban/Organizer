<?php

session_start();

// Load our autoloader
require_once(__DIR__ . '/vendor/autoload.php');

define('BASEPATH', realpath(__DIR__));
define('MODELS', BASEPATH . '/models');
define('CLASSES', BASEPATH . '/classes');

require_once(__DIR__ . '/models/AccessToken.php');

// Specify our Twig templates location
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/views');

$options = [
    // 
    'debug' => true
];

use Twig\Extra\String\StringExtension;

$twig = new Twig\Environment($loader, $options);

$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new StringExtension());

$page = explode("\\" ,getcwd());

// if id is not yet set, redirect to home

if (in_array('index', $page, true) && !isset($_SESSION['auth']['id'])) {

    header("location:/organizer1.1/index.php");
    exit;

}

// if logged in previously, redirect to index

if ((in_array('loginpage', $page, true) || 4 === count($page)) && isset($_SESSION['auth']['id'])) {

    header("location:/organizer1.1/index/index.php");
    exit;

}

// if id is set and has invalid token, delete

if (isset($_SESSION['auth']['token']) && false === AccessToken::isValid()) {
    
    unset($_SESSION['auth']['token']);
    AccessToken::clear();

}

?>