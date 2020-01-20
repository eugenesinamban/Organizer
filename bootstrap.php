<?php
// Load our autoloader
require_once(__DIR__ . '/vendor/autoload.php');

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



// var_dump(INDEX . '/');

?>