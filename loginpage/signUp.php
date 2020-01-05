<?php session_start();
// 
// if post is set, prepare variables
// 
if (isset($_POST['check'])) {
    // 
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["password"] = $_POST['password'];
    $conpass = $_POST['confirmPassword'];
    $_SESSION["firstName"] = $_POST['firstName'];
    $_SESSION["lastName"] = $_POST['lastName'];
    //
    // if set password and confirm is not matching, return error
    // 
    if ($_SESSION["password"] !== $conpass) {
        $_SESSION['message'] = "Password did not match!";
        header("location:signUp.php?error=on");
    }
    // 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <title>Sign Up Page</title>
</head>
<body>
    <header class="has-text-centered">
        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title is-1"><a href="../index.php">Organizer</a></h1>
                </div>
            </div>
        </section>
    </header>
    <main id="signUp">
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column is-two-fifths is-centered">
                        <?php 
                        if (isset($_GET['error']) && "on" === $_GET['error'] && isset($_SESSION['message'])) :
                        ?>
                        <div class="has-text-danger">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php 
                        $_SESSION = [];
                        endif;
                        ?>
                        <div class="box">
                            <?php 
                                if (!isset($_POST['check'])) :
                            ?>
                            <h2>Insert Details</h2>
                            <form action="signUp.php" method="post">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="email" name="email" id="email" placeholder="E-mail Address" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="password" name="password" id="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="lastName" id="lastName" placeholder="Last Name"required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                <input class="input" type="text" name="firstName" id="firstName" placeholder="First Name"required>
                                    </div>
                                </div>
                                <div class="field">
                                    <input type="submit" name="check" class="button is-primary">
                                </div>
                            </form>
                            <br>
                            <div class="field">
                                <h2 class="is-size-5">Already have an account?</h2>
                                <a href="../index.php" class="button is-danger is-light">Go Back!</a>
                            </div>
                            <?php 
                                elseif (isset($_POST['check'])) :
                            ?>
                            <div class="field is-large">
                                <h2>Please Confirm</h2>
                            </div>
                            <form action="signUpHandling.php" method="post">
                                <div class="field">
                                    <h2>Email : <?php echo htmlspecialchars($_SESSION["email"], ENT_QUOTES); ?></h2>
                                </div>
                                <div class="field">
                                    <h2>Password : NOT SHOWN FOR SECURITY </h2>
                                </div>
                                <div class="field">
                                        <h2>Last Name : <?php echo htmlspecialchars($_SESSION["lastName"], ENT_QUOTES); ?></h2>
                                </div>
                                <div class="field">
                                        <h2>First Name : <?php echo htmlspecialchars($_SESSION["firstName"], ENT_QUOTES); ?></h2>
                                </div>
                                <div class="field">
                                    <button type="submit" class="button is-primary is-grouped-centered">submit</button>
                                    <a href="signup.php" class="button is-danger is-light is-grouped-centered">Go Back</a>
                                </div>
                            </form>
                            <?php 
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <?php require_once("../inc/footer.html"); ?>
    </footer>        
</body>
</html>