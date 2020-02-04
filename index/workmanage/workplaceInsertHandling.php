<?php 
try {
    
    // prepare files
    
    require_once("../../bootstrap.php");
    require_once(MODELS . "/Workplace.php");
    
    // prepare input for query
    // check if value property matches with SQL
    
    // checks if input is valid, then escapes input
    
    $parameters = [
        
        "workplace",
        "wage",
        "transportation",
        "address",
        "contactDetails",
        "startDate"

    ];

    foreach ($parameters as $param) {

        $objects[$param] = $_POST[$param] ?? null;

    }

    if (!is_numeric($objects['wage']) || !is_numeric($objects['transportation'])) {
        
        throw new Exception("BACK OFF HACKER");
        
    }

    $objects['userId'] = $_SESSION['auth']['id'];
    // proceed with insert
    //
    Workplace::insert($objects);
    //
    echo $twig->render("/index/handling.twig");
    //
    // redirect if sucessful
    // 
    header("refresh:2;url=index.php");

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
    // show error page with message
    //
    echo $e->getMessage();
    $_SESSION['error']  = $e->getMessage();
    header("location:index.php?error=on");
    exit;
    //
}

?>