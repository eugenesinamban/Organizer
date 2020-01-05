<?php session_start();
require_once("../../classes/Output.php");
require_once("../../classes/Users.php");
try {
    //
    // prepare input for query
    //
    $objects = Users::updatePrepare($_POST);
    //
    if (!$objects) {
        //
        throw new Exception("Input is invalid!");
    }
    //
    // check if current email matches with input
    //
    $currentUser = Output::fetchUser($objects['oldEmail']);
    //
    if ($currentUser['id'] !== $_SESSION['id']) {
        //
        throw new Exception("Did not match with current E-mail Address!");
    }
    //
    // check if user is available
    //
    if (Output::fetchUser($objects['newEmail'])) {
        //
        throw new Exception("Username unavailable, please choose another!");
    }
    //
    // if available, prepare objects
    // 
    $objects = [
        //
        'email' => $objects['newEmail'],
    ];
    //
    $objects = Users::addUserId($objects);
    //  
    // proceed with update
    //
    if (!Users::update($objects)) {
        //
        throw new Exception("Error occured, please try again!");
        //
    }
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
    header("location:editProfile.php?error=on");
    exit;
}
// 
// redirect if successful
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
        <h2 class="title is-3">Please wait, being redirected.</h2>
        <span class="icon is-large">
            <i class="fas fa-spinner fa-pulse"></i>
        </span>
    </main>
    <footer class="footer">
        <?php 
            require_once("../../inc/footer.html");
        ?>
    </footer>
</body>
</html>