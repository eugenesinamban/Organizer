<?php 
session_start();

require_once("../../bootstrap.php");
require_once("../../models/Shift.php");

try {
    //
    if (isset($_POST['inputId'])) {
        
        $objects = [
            
            'inputId' => $_POST['inputId'],
            'userId' => $_SESSION['auth']['id']

        ];

        Shift::delete($objects);

    }

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