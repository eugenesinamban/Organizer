<?php 

session_start();

require_once("../../bootstrap.php");
require_once("../../models/Users.php");

try {
    
    // prepare input for query
    
    $parameters = [

        'firstName',
        'lastName'

    ];

    $objects = [];

    foreach ($parameters as $param) {

        isset($_SESSION['update'][$param]) && "" !== $_SESSION['update'][$param] ? $objects[$param] = $_SESSION['update'][$param] : null;

    }
    
    // if invalid, return exception
    
    if ([] === $objects) {
        //
        throw new Exception("Input is invalid!");
        //
    }
    
    $keys = [

        'id' => $_SESSION['auth']['id']

    ];
    
    // if good, proceed with update
    
    Users::update($objects, $keys);
    
    echo $twig->render('/index/handling.twig');

    // redirect if successful

    header("refresh:2;url=index.php");

} catch (Error $e) {
    // 
    $_SESSION = [];session_destroy();
    session_start();
    $_SESSION['error']  = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    // 
} catch (Exception $e) {
    //
    $_SESSION['error']  = $e->getMessage();
    header("location:index.php?error=on");
    exit;
}
?>