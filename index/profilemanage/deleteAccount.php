<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <?php require_once("../../inc/css.html"); ?>
    <link rel="stylesheet" href="../../style/index.css">
    <title>Delete Account</title>
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
    <main id="profile-delete">
        <section class="section">
            <div class="container">
            <?php session_start();
                if (isset($_GET['error']) && "on" === $_GET['error']) :
                ?>
                <div class="has-text-danger">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php 
                endif;
                ?>
                <div class="field">
                    <h2 class="title is-3">WARNING</h2>
                    <h2 class="title is-4">ARE YOU SURE YOU WANT TO DELETE YOUR PROFILE?</h2>
                    <h2 class="title is-4">PLEASE ENTER LOG IN DETAILS TO CONTINUE</h2>
                </div>
                <div class="column is-4 is-offset-4">
                    <form action="deleteAccountHandling.php" method="post">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" id="email" placeholder="Enter email id">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="password" id="password" placeholder="Enter password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <button type="submit" class="button is-danger is-large">DELETE ACCOUNT</button>
                        </div>
                        <div class="field">
                            <a href="index.php" class="button is-primary">Back</a>
                        </div>
                    </form>
                </div>
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