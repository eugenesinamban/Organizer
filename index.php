<?php session_start();
if(isset($_SESSION['id'])) {
    header("location:index/index.php");
    exit();
}
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null ;
//
// declare $email variable for error handling
// 
$email = isset($_SESSION["login_email"]) ? $_SESSION["login_email"] : "";
// 
$_SESSION = [];
// clear session details from sign up if any
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Organizer</title>
</head>
<body>
    <header class="has-text-centered">
        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title is-1"><a href="index.php">Organizer</a></h1>
                </div>
            </div>
        </section>
    </header>
    <main>  
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column is-two-fifths is-centered">
                        <div class="box" id="main">
                            <h2 class="title is-5">Log In</h2>
                            <?php
                            if ( (isset($_GET['error']))&&("on" == $_GET["error"]) ) :
                            ?>
                            <h3 class="title is-6 has-text-danger">
                                <?php echo $message; $message = ""; ?>
                            </h3>
                            <?php
                            endif;
                            ?>
                            <form action="loginpage/logInHandling.php" method="post">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" required type="text" name="email" id="email" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>"><br>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" required type="password" name="password" id="password" placeholder="Enter Password"><br>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <button type="submit" class="button is-primary" onclick="pageLoader()">login</button>
                                </div>
                            </form>
                            <br>
                            <div class="field">
                                <h2 class="title is-5 is-centered">No account yet?</h2>
                                <a href="loginpage/signUp.php" class="button is-primary is-light is-centered">Sign up!</a>
                            </div>
                        </div>
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </section> 
    </main>
    <footer class="footer">
        <?php require_once("inc/footer.html"); ?>
    </footer>
</body>
</html>