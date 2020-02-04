<?php 

require_once("../bootstrap.php");
require_once(MODELS . "/Users.php");

try {
    
    // prepare input for query

    $objects = [

        'email' => $_POST['email'],
        'password' => $_POST['password']

    ];

    Users::login($objects);
    // 
    // redirect if succsessful
    // 
    header("location:../index/index.php");
} catch (Throwable $e) {
    // 
    $_SESSION["login_email"] = $_POST["email"];
    $_SESSION['error'] = $e->getMessage();
    header('Location:../index.php?error=on');
    exit;
}
//
?>

