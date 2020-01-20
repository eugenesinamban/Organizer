<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../models/Workplace.php");
    require_once("../../bootstrap.php");


    $error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;
    
    $inputId = $_GET['inputId'];
    $workplace = Workplace::findBy(['inputId' => $inputId]);
    
    $viewVars = [

        'error' => $error,
        'workplace' => $workplace,
        'inputId' => $inputId

    ];

    // var_dump($twig);

    echo $twig->render('/index/workplace/workplaceDetail.twig', $viewVars);

} catch (Error $e) {
    // 
    $_SESSION = [];
    session_destroy();
    session_start();
    $_SESSION['error']  = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    // 
} catch (Exception $e) {
    //
    echo $e->getMessage();
    $_SESSION['error']  = $e->getMessage();
    // header("location:index.php?error=on");
    exit;
    // 
}
?>