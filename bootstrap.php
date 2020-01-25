<?php
// Load our autoloader
require_once(__DIR__ . '/vendor/autoload.php');
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

define('INDEX', realpath(__DIR__));

if (isset($_SESSION['auth']['id'])) {

    // require_once(ROOT . "/antiHack.php");

    if (isset($_SESSION['auth']['token']) && false === AccessToken::isValid()) {
        
        AccessToken::clear();
    
    }
}

// var_dump(INDEX . '/');

?>