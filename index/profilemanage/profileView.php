<?php 
try {
    // 
    // prepare files
    // 
    require_once("../../bootstrap.php");
    require_once(MODELS . "/Users.php");
    // 
    // prepare objects
    // 
    $user = Users::findBy(['id' => $_SESSION['auth']['id']]);
    
    $viewVars = [

        'user' => $user

    ];

    echo $twig->render('/index/profile/profileView.twig', $viewVars);

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