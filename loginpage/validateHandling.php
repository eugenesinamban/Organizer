<?php 

session_start();

require_once("../bootstrap.php");
require_once("../classes/Mail.php");
require_once("../models/Users.php");
// 
try {
    
    $user = Users::prepare(['email'=> $_POST['email']]);

    $user = Users::findBy(['email' => $user['email']]);

    if (1 === $user['verified']) {
        
        throw new Exception('Already verified! Please proceed with log in!');

    }

    Mail::send($user);
    
    echo $twig->render('/handling.twig');

    header("refresh:2;url=../index.php");
    
} catch (Throwable $e) {
    // 
    $_SESSION['error'] = $e->getMessage();
    header("location:validate.php?error=on");
    exit;
}
?>