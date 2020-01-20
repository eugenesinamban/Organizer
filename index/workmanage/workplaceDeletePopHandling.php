<?php 
try {
    session_start();

    require_once("../../bootstrap.php");
    require_once("../../models/Workplace.php");
    
    // prepare input for query
    // checks if input is valid, then escapes input
    if (isset($_POST['inputId'])) {

        $objects = [
    
            'inputId' => $_POST['inputId'],
            'userId' => $_SESSION['auth']['id']
    
        ];
        
        // after preparing objects, adding user id, proceed with deletion
        
        Workplace::delete($objects);

    }
    
    echo $twig->render("/index/popHandling.twig");

} catch (Error $e) {
    // 
    $_SESSION = [];
    session_destroy();
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
    window.opener.location.href = 'index.php?error=on';
    window.close();
    </script>
    <?php
    exit;
}
?>