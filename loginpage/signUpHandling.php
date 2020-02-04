<?php

require_once('../bootstrap.php');
require_once(MODELS . "/Users.php");
// 
try {
    //
    // prepare input for query
    // checks if input is valid, then escapes input
    // 
    Users::signUp($_SESSION['signUp']);
    // 
    // destroy session and session values
    // 
    $_SESSION = [];
    // 
    header("refresh:2;url=../index.php");
    // 
} catch (Throwable $e) {
    // 
    $_SESSION = [];
    $_SESSION['error'] = $e->getMessage();
    header("location:signUp.php?error=on");
    exit;
    // 
}
// 
echo $twig->render('handling.twig');

?>
