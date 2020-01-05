<?php session_start();
require_once("../../classes/Output.php");
require_once("../../classes/Authenticate.php");
//
$date = isset($_GET['date']) && is_numeric($_GET['date']) ? $_GET['date'] : "";
$month = isset($_GET['month']) && false !== strtotime($_GET['month']) ? $_GET['month'] : "";
$year = isset($_GET['year']) && is_numeric($_GET['year']) ? $_GET['year'] : "";
//
$dateValue = date("Y-m-d", strtotime($year . ", " . $month . " " . $date));
// 
$objects = [
    // 
    $date,
    $month,
    $year,
    $dateValue
];
//
if (false === Authenticate::inputIsValid($objects)) {
    // 
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
    <title>Document</title>
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
    <main id="shift-input">`
        <section class="section">
            <div class="container is-fluid">
                <div class="column is-6 is-offset-3">
                    <div class="box">
                        <form action="addShiftHandling.php" method="post">
                            <div class="field"> 
                                <label class="label" for="date1">Shift Start Date : </label>
                                <div class="control">
                                    <input class="input" type="date" name="shiftDateStart" id="date1" min="2019-01-01" max="2050-12-31" value="<?php echo isset($dateValue) ? $dateValue : null ; ?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="shift_Start">Shift Start : </label>
                                <div class="control">
                                        <input class="input" type="time" name="shiftStart" id="shift_Start" placeholder="Shift Start" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="date2">Shift End Date :</label>
                                <div class="control">
                                    <input class="input" type="date" name="shiftDateEnd" id="date2" min="2019-01-01" max="2050-12-31" value="<?php echo isset($dateValue) ? $dateValue : null ; ?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="shift_End">Shift End : </label>
                                <div class="control">
                                        <input class="input" type="time" name="shiftEnd" id="shift_End" placeholder="Shift End" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="workplace">Workplace : </label>
                                <div class="control is-expanded">
                                    <div class="select is-fullwidth">
                                        <select name="workplaceId" id="workplace">
                                            <?php 
                                            foreach (Output::getWorkplaces() as $workplace) :
                                            ?>
                                                <option value="<?php echo $workplace['inputId']; ?> "><?php echo $workplace['workplace']; ?></option>
                                            <?php 
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button type="submit" class="button is-primary">Submit</button>
                                <a class="button is-danger" href="details.php?date=<?php echo $date; ?>&month=<?php echo $month; ?>&year=<?php echo $year; ?>">Back</a>
                            </div>
                        </form>
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