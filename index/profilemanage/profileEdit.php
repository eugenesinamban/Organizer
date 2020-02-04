<?php 

require_once("../../bootstrap.php");

$updateProfile = $_POST['updateProfile'] ?? null;
$updateEmail = $_POST['updateEmail'] ?? null;
$updatePassword = $_POST['updatePassword'] ?? null;
$error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;

$viewVars = [

    'updateProfile' => $updateProfile,
    'updateEmail' => $updateEmail,
    'updatePassword' => $updatePassword,
    'error' => $error

];

echo $twig->render('/index/profile/profileEdit.twig', $viewVars);

?>