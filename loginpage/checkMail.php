<?php 

session_start();

require_once("../bootstrap.php");
require_once("../models/Users.php");

try {
    // 
    if ([] === $_GET) {
        // 
        throw new Exception("Error!");
    }
    // 
    $user = Users::findBy(['email' => $_GET['email']]);
    // 
    if (false === $user) {
        // 
        throw new Exception("Error occured! Please try again!");
    }
    //
    
    $objects = [

        'verified' => 1

    ];

    $parameters = [

        'token',
        'email'

    ];
    $tableKeys = [];
    foreach ($parameters as $key) {
        
        $tableKeys[$key] = $_GET[$key];
    }
    
    Users::update($objects, $tableKeys);
    
    echo $twig->render('handling.twig');

    header("refresh:2;url=../index.php");
    // 
} catch (Exception $e) {
    // 
    $_SESSION['error']  = $e->getMessage();
    header("location:../index.php?error=on");
    exit;
    // 
}
?>