<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Users.php");

try {
    //
    // prepare input
    //
    $parameters = [

        'email' => $_POST['email'],
        'password' => $_POST['password']

    ];
    
    $objects = Users::prepare($parameters);
    
    // if log in is valid, check if it's the same as the one logged in
    
    $checkUser = Users::findBy(['email' => $objects['email']]);
    
    if ($checkUser['id'] !== $_SESSION['auth']['id']) {
        //
        throw new Exception("Incorrect E-mail and password combination!");
        //
    }

    if (false === password_verify($objects['password'], $checkUser['password'])) {

        throw new Exception("Incorrect E-mail and password combination!");

    }

    $objects = [
        
        'id' => $_SESSION['auth']['id']

    ];
    
    Users::delete($objects);

    echo $twig->render('/index/profile/accountDeleteHandling.twig');
    
    // redirect if successful
    
    header("refresh:3;url=../../logoutHandling.php");
    // 
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
    header("location:deleteAccount.php?error=on");
    exit;
}
?>