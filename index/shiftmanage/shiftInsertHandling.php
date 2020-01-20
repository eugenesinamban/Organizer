<?php 

session_start();

require_once("../../bootstrap.php");
require_once("../../models/Shift.php");

// 
try {
    //
    // prepare input for query
    // if input is valid, escape
    $parameters = [

        'shiftDateStart',
        'shiftStart',
        'shiftDateEnd',
        'shiftEnd',
        'workplaceId'

    ];
    // 
    foreach ($parameters as $param) {
        
        $objects[$param] = $_POST[$param];

    }

    $objects['userId'] = $_SESSION['auth']['id'];
    // 
    // proceed with insert
    // 
    Shift::insert($objects);

    echo $twig->render("/index/popHandling.twig");
    // 
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