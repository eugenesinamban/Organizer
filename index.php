<?php

require_once(__DIR__.'/bootstrap.php');

$error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;

$email = $_SESSION["login_email"] ?? "";

$viewVars = [
    // 
    'error' => $error,
    'email' => $email
];

echo $twig->render('logIn.twig', $viewVars );
$_SESSION = [];
?>