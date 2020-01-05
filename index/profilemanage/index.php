<?php session_start();
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
    <title>Shift Manage</title>
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
    <main id="profile-edit">
        <section class="section">
            <div class="container is-fluid">
                <div class="column is-4 is-offset-4">
                    <?php 
                    if (isset($_GET['error']) && "on" === $_GET['error']) :
                    ?>
                    <div class="has-text-danger">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php 
                    endif;
                    ?>
                    <div class="box">
                        <h2 class="title is-3">Manage Profile</h2>
                        <div class="field">
                            <div class="control">
                                <a href="viewProfile.php" class="button is-info is-fullwidth">View Profile</a>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <a href="editProfile.php" class="button is-warning is-fullwidth">Edit Profile</a>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <a href="deleteAccount.php" class="button is-danger is-fullwidth">Delete Account</a>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <a href="../index.php" class="button is-primary is-fullwidth">Back</a>
                            </div>
                        </div>
                    </div>
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