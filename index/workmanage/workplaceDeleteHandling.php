<?php session_start();
try {
    // 
    require_once("../../bootstrap.php");
    require_once("../../models/Workplace.php");
    
    // prepare input for query
    // checks if input is valid, then escapes input

    if (isset($_POST['inputId'])) {

        $objects = [
        
            'inputId' => $_POST['inputId'],
            'userId' => $_SESSION['auth']['id']
    
        ];
        
        // after preparing objects, proceed with deletion
        //
        
        Workplace::delete($objects);

        //  redirect if successful
        echo $twig->render('/index/handling.twig');

        header("refresh:2;url=index.php");
    }
    // 
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
    $_SESSION['error']  = $e->getMessage();
    header("location:index.php?error=on");
    exit;
    //
}
?>