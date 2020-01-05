<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../classes/Output.php");
    // 
    // prepare objects
    // 
    $user = Output::fetchUserDetails();
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
    header("location:index.php?error=on");
    exit;
} 
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
    <main id="profile-view">
        <section class="section">
            <div class="container">
                <div class="column is-4 is-offset-4">
                    <h2 class="title is-3">Profile</h2>
                    <table class="table is-striped is-fullwidth is-bordered">
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                <?php
                                echo htmlspecialchars($user['lastName']) . " " . htmlspecialchars($user['firstName'], ENT_QUOTES);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email Address
                            </td>
                            <td>
                                <?php
                                echo htmlspecialchars($user['email'], ENT_QUOTES);
                                ?>
                            </td>
                        </tr>
                    </table>
                    <div class="field">
                        <a href="index.php" class="button is-primary">Back</a>
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