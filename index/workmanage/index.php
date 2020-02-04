<?php 
try {
    // 
    // prepare files
    require_once("../../bootstrap.php");
    require_once(MODELS . "/Workplace.php");


    $workplace = new Workplace();
    $error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;


    $viewVars = [
        // 
        'error' => $error,
        'workplace' => $workplace
    ];

    echo $twig->render("/index/workplace/workplaceIndex.twig", $viewVars);
    // 
} catch (Error $e) {
    // 
    session_start();
    $_SESSION['error']  = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    // 
} catch (Exception $e) {
    // 
    $_SESSION['error']  = $e->getMessage();
    header('location:./index.php?error=on');
    exit;
}
?>
