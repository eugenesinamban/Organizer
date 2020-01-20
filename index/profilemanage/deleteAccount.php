<?php 

session_start();

require_once("../../bootstrap.php");

$error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;

$viewVars = [

    'error' => $error

];

echo $twig->render('/index/profile/accountDelete.twig', $viewVars);

?>