<?php session_start();
require_once("../classes/Users.php");
require_once("../classes/Authenticate.php");
// 
// prepare input for query
// checks if input is valid, then escapes input
// 
try {
    // 
    Authenticate::login($_POST);    
    // 
    // redirect if succsessful
    // 
    header("location:../index/index.php");
    // 
} catch (Throwable $e) {
    // 
    $_SESSION["login_email"] = $_POST["email"];
    $_SESSION['message'] = $e->getMessage();
    header('Location:../index.php?error=on');
    exit;
}
//
?>

