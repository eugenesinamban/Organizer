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
    <main>
        <section class="section">
            <div class="container is-fluid">
                <?php 
                if (isset($_GET['error']) && "on" === $_GET['error']) :
                ?>
                <div class="has-text-danger">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php 
                endif;
                if (!isset($_POST['updatePassword']) && !isset($_POST['updateProfile']) && !isset($_POST['updateEmail'])) :
                ?>
                <div id="profile-edit">
                    <div class="column is-4 is-offset-4">
                        <div class="box">
                            <form action="#" method="post">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-warning is-fullwidth" name="updateEmail">Update E-mail Address</button>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-warning is-fullwidth" name="updateProfile">Update Profile</button>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-warning is-fullwidth" name="updatePassword">Update Password</button>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <a class="button is-danger is-fullwidth" href="index.php">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                elseif (isset($_POST['updatePassword'])) :
                ?>
                <div id="profile-input">
                    <div class="column is-4 is-offset-4">
                        <div class="box">
                            <form action="updatePassword.php" method="post">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" name="oldPassword" placeholder="Old Password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" name="newPassword" placeholder="New Password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" name="confirmPassword" placeholder="Confirm Password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <button type="submit" class="button is-primary">Submit</button>
                                    <a href="" class="button is-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                    elseif (isset($_POST['updateEmail'])) :
                ?>
                <div id="profile-input">
                    <div class="column is-4 is-offset-4">
                        <div class="box">
                            <form action="updateEmail.php" method="post">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" name="oldEmail" placeholder="Old E-mail Address">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" name="newEmail" placeholder="New E-Mail Address">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <button class="button is-primary" type="submit">Submit</button>
                                    <a href="" class="button is-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                    elseif (isset($_POST['updateProfile'])) :
                ?>
                <div id="profile-input">
                    <div class="column is-4 is-offset-4">
                        <div class="box">
                            <form action="updateProfile.php" method="post">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="lastName" id="lastname" placeholder="Last Name"><br>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="firstName" id="firstname" placeholder="First Name"><br>
                                    </div>
                                </div>
                                <div class="field">
                                    <button type="submit" class="button is-primary">Submit</button>
                                    <a href="" class="button is-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    endif;
                ?>
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