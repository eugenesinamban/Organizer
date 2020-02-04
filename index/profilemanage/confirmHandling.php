<?php 
 
require_once("../../bootstrap.php");
require_once(MODELS . "/Users.php");
require_once(MODELS . "/AccessToken.php");
require_once(CLASSES . "/Token.php");

try {
    
    // prepare input
    
    $parameters = [

        'email' => $_POST['email'],
        'password' => $_POST['password']

    ];

    $objects = Users::prepare($parameters);
    
    // if log in is valid, check if it's the same as the one logged in

    $checkUser = Users::findBy(['email' => $objects['email']]);
    
    if ($checkUser['id'] !== $_SESSION['auth']['id']) {
        
        throw new Exception("Incorrect E-mail and password combination!");
        
    }
    
    if (false === password_verify($objects['password'], $checkUser['password'])) {

        throw new Exception("Incorrect E-mail and password combination!");

    }

    // all check passed, may proceed with update

    $_SESSION['auth']['token'] = Token::generate();
    
    if (AccessToken::findBy(['userId' => $_SESSION['auth']['id']])) {

        $objects = [

            'token' => $_SESSION['auth']['token'],
            'log' => time() + 3600
    
        ];        
        
        AccessToken::update($objects, ['userId' => $_SESSION['auth']['id']]);

    } else {

        $objects = [

            'token' => $_SESSION['auth']['token'],
            'userId' => $_SESSION['auth']['id'],
            'log' => time() + 3600
    
        ];
        
        AccessToken::insert($objects);

    }

    header('location:profileEdit.php');
    exit;

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
    $_SESSION['error'] = $e->getMessage();
    header("location:confirm.php?error=on");
    exit;
}
?>