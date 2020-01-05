<?php session_start();
require_once("../classes/Output.php");
require_once("../classes/Users.php");
// 
try {
    // 
    Users::insert($_SESSION);
    // 
    // destroy session and session values
    // 
    $_SESSION = [];
    // 
    // create header for message, decide which page to go to after parsing session objects
    // 
    header("refresh:2;url=../index.php");
    // 
} catch (Throwable $e) {
    // 
    $_SESSION['message'] = $e->getMessage();
    header("location:signUp.php?error=on");
    exit;
    // 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script async defer src="https:buttons.github.io/buttons.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <title>Organizer</title>
</head>
<body>
    <div id="wrap">
        <header>
            <section class="hero">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title is-1"><a href="../index.php">Organizer</a></h1>
                    </div>
                </div>
            </section>
        </header>
        <main>
            <section class="section is-medium">
                <div class="container">
                    <h2 class="title is-3">
                        Sign up successful!
                    </h2>
                    <span class="icon is-large">
                        <i class="fas fa-spinner fa-pulse"></i>
                    </span>
                </div>
            </section>
        </main>
        <footer class="footer">
            <?php require_once("../inc/footer.html"); ?>
        </footer>
    </div>
</body>
</html>