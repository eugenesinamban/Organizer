<?php session_start();
try {
    
    // prepare files
    
    require_once("../../bootstrap.php");
    require_once("../../models/Workplace.php");
    
    $inputId = $_GET['inputId'] ?? $_POST['inputId'] ?? null;

    $error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;

    $viewVars = [

        'inputId' => $inputId,
        'error' => $error,
        'workplaces' => Workplace::getWorkplaces()

    ];
    echo $twig->render('/index/workplace/workplaceUpdate.twig', $viewVars);
    
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
    $_SESSION['error'] = $e->getMessage();
    header('location:/organizer-breakable/index/workmanage/index.php?error=on');
    exit;
}
?>
