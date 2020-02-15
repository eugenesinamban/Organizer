<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Users.php");

try {
    
    // prepare input for query
    
    $parameters = [

        'newEmail',
        'oldEmail'

    ];
    
    foreach ($parameters as $param) {

        $objects[$param] = $_POST[$param];

    }

    // find user from old email and check if it really is the current user

    $user = Users::findBy(['email' => $objects['oldEmail']]);
    
    if ($user['id'] !== $_SESSION['auth']['id']) {
        
        throw new Exception("Did not match with current E-mail Address!");

    }
    
    // check if new email is available
    
    if (users::findBy(['email' => $objects['newEmail']])) {
        
        throw new Exception("Username unavailable, please choose another!");

    }

    if (AccessToken::findBy(['userId' => $_SESSION['auth']['id']])['token'] !== $_SESSION['auth']['token']) {

        throw new Exception("Edit unauthorized!");

    }

    AccessToken::clear();
    
    // if available, prepare objects and keys
    
    $objects = [
        
        'email' => $objects['newEmail'],

    ];

    $key = [

        'id' => $_SESSION['auth']['id']

    ];

    // proceed with update
    
    Users::update($objects, $key);

    echo $twig->render('/index/handling.twig');
    
    // redirect if successful

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