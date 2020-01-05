<?php   session_start();
try {
    // 
    // prepare files
    // 
    require_once("antiHack.php");
    require_once("../classes/Output.php");
    require_once("../classes/Calendar.php");
    require_once("../classes/Authenticate.php");
    // 
    // check if DB connection is live
    // 
    DB::databaseConnect();
    // 
    // prepare objects
    // 
    isset($_GET['month']) && is_numeric($_GET['month']) ? (Calendar::setMonth(htmlspecialchars($_GET['month']))) : null;
    isset($_GET['year']) && is_numeric($_GET['year']) ? (Calendar::setYear(htmlspecialchars($_GET['year']))) : null;
    $month = Calendar::getMonth();
    $year = Calendar::getYear();
    $endDate = Calendar::endDate();
    $startDay = Calendar::startDay();
    $date1 = 1;
    $date2 = 1;
    $counter1 = 1;
    $counter2 = 1;
    // 
    // 
} catch (Throwable $e) {
    // 
    Authenticate::logout();
    session_start();
    $_SESSION['message'] = $e->getMessage();
    header("location:../index.php?error=on");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../style/index.css">
    <script>
        // JavaScript popup window function
        function basicPopup(url) {
            //`
            popupWindow = window.open(  url,
                                        'popUpWindow',
                                        'height=600,width=400,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
        }
        //
    </script>
    <title>Organizer</title>
</head>
<body>
    <header>
        <section class="hero">
            <div class="hero-body">
                <h1 class="title is-1"><a href="index.php">Organizer</a></h1>
                <div class="line"></div>
            </div>
        </section>
    </header>
    <main id="calendar">
        <section class="section is-fullwidth is-hidden-desktop">
            <div class="container">
                <?php 
                if (isset($_GET['error']) && "on" === $_GET['error']) :
                ?>
                <div class="has-text-danger">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php 
                endif;
                ?>
                <h2 class="title is-2">Dashboard</h2>
                <?php 
                    require("welcomeHiddenDesktop.php");
                ?>
                <div class="has-text-danger">
                <?php 
                if (False === Output::getWorkplaces() && false === Output::hasShift()) {
                    // 
                    echo "Please add workplace details at Workplace Management first to add shifts!";
                    // 
                } elseif (False !== Output::getWorkplaces() && False === Output::hasShift()) {
                    // 
                    echo "You may now start adding shifts!";
                    // 
                }
                ?>
                </div>
                <div id="main-buttons">
                    <div class="buttons is-centered">
                        <a href="workmanage"class="button is-normal is-info is-inverted">Workplace Management</a>
                        <a href="profilemanage"class="button is-normal is-info is-inverted">Profile Management</a>
                        <a href="breakdown" class="button is-normal is-info is-inverted">Breakdown</a>
                    </div>
                    <div class="buttons is-centered">
                        <a href="../logoutHandling.php"class="button is-normal is-danger">Log Out</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section is-hidden-touch">
            <div class="container">
                <div class="column is-10 is-offset-1">
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
                        <h2 class="title is-2">Dashboard</h2>
                        <?php 
                            require("welcomeHiddenTouch.php");
                        ?>
                        <div class="has-text-danger">
                        <?php 
                        if (False === Output::getWorkplaces() && false === Output::hasShift()) {
                            // 
                            echo "Please add workplace details at Workplace Management first to add shifts!";
                            // 
                        } elseif (False !== Output::getWorkplaces() && False === Output::hasShift()) {
                            // 
                            echo "You may now start adding shifts!";
                            // 
                        }
                        ?>
                        </div>
                        <div id="main-buttons">
                            <div class="buttons is-centered">
                                <a href="workmanage"class="button is-normal is-info is-outlined">Workplace Management</a>
                                <a href="profilemanage"class="button is-normal is-info is-outlined">Profile Management</a>
                                <a href="breakdown" class="button is-normal is-info is-outlined">Breakdown</a>
                            </div>
                            <div class="buttons is-centered">
                                <a href="../logoutHandling.php"class="button is-normal is-danger">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <?php 
            require_once("../inc/footer.html");
        ?>
    </footer>
</body>
</html>