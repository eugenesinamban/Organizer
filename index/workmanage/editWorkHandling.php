<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../classes/Workplace.php");
    //
    // prepare input for query
    // checks if input is valid, then escapes input
    //
    if (!is_numeric($_POST['wage']) && "" !== $_POST['wage']) {
        //
        throw new Exception("BACK OFF HACKER");
        //
    }
    // 
    if (!is_numeric($_POST['transportation']) && "" !== $_POST['transportation']) {
        //
        throw new Exception("BACK OFF HACKER");
        //
    }
    // 
    Workplace::update($_POST);
    // 
    // redirect if successful
    // 
    header("refresh:2;url=index.php");
    // 
} catch (Error $e) {
    // 
    Authenticate::logout();
    session_start();
    $_SESSION['message'] = $e->getMessage();
    header("location:../../index.php?error=on");
    exit;
    // 
} catch (Exception $e) {
    // 
    $_SESSION['message'] = $e->getMessage();
    header('location:editWork.php?error=on&inputId=' . $_POST['inputId']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once("../../inc/css.html"); ?>
    <link rel="stylesheet" href="../../style/index.css">
    <title>Work Management</title>
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
    <main class="handling">
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