<?php 

session_start();

require_once("../../bootstrap.php");
require_once("../../models/Users.php");

$error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;

try {

    foreach($_POST as $key => $value) {

        $_SESSION['update'][$key] = $value;

    }

    $viewVars = [
    
        'error' => $error
    
    ];
    
    echo $twig->render('/index/profile/confirm.twig', $viewVars);

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
    header("location:profileEdit.php?error=on");
    exit;
}
?>