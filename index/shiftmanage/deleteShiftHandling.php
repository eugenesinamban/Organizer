<?php session_start();
require_once("../../classes/Shift.php");
//
// add shift handling script
//
// prepare input for query
// if input is valid, escape
//
try {
    //
    Shift::delete($_POST);
    //
} catch (Error $e) {
    // 
    Authenticate::logout();
    session_start();
    $_SESSION['message'] = $e->getMessage();
    ?>
    <script>
    window.opener.location.href = '../../index.php?error=on';
    window.close();
    </script>
    <?php
    exit;
    // 
} catch (Exception $e) {
    //
    $_SESSION['message'] = $e->getMessage();
    ?>
    <script>
    window.opener.location.href = '../index.php?error=on';
    window.close();
    </script>
    <?php
    exit;
    //  
}
//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <?php require_once("../../inc/css.html"); ?>
    <link rel="stylesheet" href="../../style/index.css">
    <script type="text/javascript">
            function closeWindow() {
                //
                setTimeout(function() {
                    //
                    window.close();
                }, 500);
            }
            //
            window.onload = closeWindow();
            window.onunload = function(){
                //
                window.opener.location.reload();
            };
        </script>
    <title>Document</title>
</head>
<body>
    <header>
        <section class="hero">
            <div class="hero-body">
                <header>
                    <h1 class="title is-1"><a href="../index.php">Organizer</a></h1>
                    <div class="line"></div>
                </header>
            </div>
        </section>
    </header>
    <main>
        <section class="section is-medium">
            <div class="container">
                <h2 class="title is-3">Please wait, being redirected.</h2>
                <span class="icon is-large">
                    <i class="fas fa-spinner fa-pulse"></i>
                </span>
            </div>
        </section>
    </main>
    <footer class="footer">
        <?php
            require_once("../../inc/footer.html");
        ?>
    </footer>
    
</body>
</html>