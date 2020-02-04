<?php 
try {
    // 
    // prepare files
    // 
    require_once("../../bootstrap.php");
    require_once(MODELS . "/Workplace.php");
    //
    // prepare input for query
    // checks if input is valid, then escapes input
    //
    if (!is_numeric($_POST['wage']) && "" !== $_POST['wage']) {
        //
        throw new Exception("BACK OFF HACKER");
        //
    }
    // 
    if (!is_numeric($_POST['transportation']) && "" !== $_POST['transportation']) {
        //
        throw new Exception("BACK OFF HACKER");
        //
    }
    // 
    $parameters = [

        'workplace',
        'wage',
        'transportation',
        'address',
        'contactDetails',
        'startDate',

    ];

    $keys = [

        'inputId' => $_POST['inputId'],
        'userId' => $_SESSION['auth']['id']

    ];

    foreach ($parameters as $param) {

        isset($_POST[$param]) && '' !== $_POST[$param] ? $objects[$param] = $_POST[$param] : null;

    }
    
    // after preparing objects, adding user id, proceed with edit
    
    Workplace::update($objects, $keys);
    
    echo $twig->render('index/handling.twig');
    
    // redirect if successful
    
    header("refresh:2;url=index.php");
    
} catch (Error $e) {
    
    $_SESSION = [];
    session_destroy();
    session_start();
    $_SESSION['error']  = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    
} catch (Exception $e) {
    
    $_SESSION['error']  = $e->getMessage();
    header('location:workplaceUpdate.php?error=on&inputId=' . $_POST['inputId']);
    exit;
    
}
?>