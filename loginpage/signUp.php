<?php session_start();
require("../bootstrap.php");
// 
// if post is set, prepare variables
// 
$post = $_POST ?? null;

if ("POST" === $_SERVER['REQUEST_METHOD']) {
    // 
    // 
    $parameters = ['email', 'password', 'firstName', 'lastName'];
    // 
    foreach ($parameters as $value) {
        // 
        $_SESSION['signUp'][$value] = $post[$value];
    }
    //
    // if set password and confirm is not matching, return error
    // 
    if ($_SESSION['signUp']["password"] !== $_POST['confirmPassword']) {
        // 
        $_SESSION['error']  = "Password did not match!";
        header("location:signUp.php?error=on");
    }
    // 
}
// 
$error = isset($_GET['error']) && 'on' === $_GET['error'] ? $_SESSION['error'] : null;
// 
$viewVars = [
    // 
    'error' => $error,
    'post' => $post,
    'signUp' => $_SESSION['signUp'] ?? null,
];
// 
echo $twig->render('signUp.twig', $viewVars);
?>
