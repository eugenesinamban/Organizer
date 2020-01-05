<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../classes/Workplace.php");
    //
    // prepare input for query
    // check if value property matches with SQL
    //
    if (!is_numeric($_POST['wage']) || !is_numeric($_POST['transportation'])) {
        //
        throw new Exception("BACK OFF HACKER");
        //
    }
    //
    // proceed with insert
    //
    Workplace::insert($_POST);
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
    // show error page with message
    //
    $_SESSION['message'] = $e->getMessage();
    header("location:index.php?error=on");
    exit;
    //
}
//
// redirect if sucessful
// 
header("refresh:2;url=index.php");
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