<pre>
    <?php 
        /////////////////////////////////////////////////
        //                                             //
        //            Testing area for methods         //
        //                                             //
        /////////////////////////////////////////////////
        // 
        session_start();
        require_once("Token.php");
        $token = Token::generate();

        $_SESSION['token'] = Token::generate();

        var_dump($_SESSION['token']);

        header('refresh:5;url:tester2.php');
    ?>


</pre>
