<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Users.php");

try {

    // prepare input for query
    
    $parameters = [

        'oldPassword',
        'newPassword',
        'confirmPassword'

    ];

    foreach ($parameters as $param) {
        
        $objects[$param] = $_POST[$param];

    }
    //
    if ($objects['newPassword'] !== $objects['confirmPassword']) {
        //
        throw new Exception("Password did not match!");
        //
    }
    
    $user = Users::findBy(['id' => $_SESSION['auth']['id']]);
    
    if (!password_verify($objects['oldPassword'], $user['password'])) {
        //
        throw new Exception("Did not match with Old Password!");
        //
    }
    
    // if it matches, hash new pass
    
    $values['password'] = password_hash($objects['newPassword'], PASSWORD_DEFAULT);
    
    // create new objects for update
    
    $keys = [
        //
        'id' => $_SESSION['auth']['id']
        //
    ];
    
    // proceed with update
    
    Users::update($values, $keys);

    echo $twig->render('/index/handling.twig');

    // if successful, redirect
    
    header("refresh:2;url=index.php");
    
} catch (Error $e) {
    // 
    $_SESSION = [];session_destroy();
    session_start();
    $_SESSION['error']  = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    // 
} catch (Exception $e) {
    //
    $_SESSION['error']  = $e->getMessage();
    header("location:index.php?error=on");
    exit;
}

?>