<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Shift.php");
//
try {
    
    $inputId = $_POST['inputId'] ?? null;

    $objects = [];

    $parameters = [
        
        'shiftDateStart',
        'shiftStart',
        'shiftDateEnd',
        'shiftEnd',
        'workplaceId'
        
    ];

    $keys = [

        'inputId' => $inputId,
        'userId' => $_SESSION['auth']['id']

    ];

    foreach ($parameters as $param) {

        isset($_POST[$param]) && '' !== $_POST[$param] ? $objects[$param] = $_POST[$param] : null;

    }

    if ([] === $objects || null === $inputId) {

        throw new Exception("Please enter valid input!");

    }

    Shift::update($objects, $keys);

    echo $twig->render('/index/popHandling.twig');
    
} catch (Error $e) {
    // 
    $_SESSION = [];session_destroy();
    session_start();
    $_SESSION['error']  = $e->getMessage();
    ?>
    <script>
    window.opener.location.href = '../../index.php?error=on';
    window.close();
    </script>
    <?php
    exit;
    // 
} catch (Exception $e) {
    //
    $_SESSION['error']  = $e->getMessage();
    ?>
    <script>
    window.opener.location.href = '../index.php?error=on';
    window.close();
    </script>
    <?php
    exit;
    //  
}
//
?>