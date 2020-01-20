<?php session_start();
require_once("../../classes/Calendar.php");
require_once("../../classes/Output.php");
// 
$inputId = isset($_GET['inputId']) ? $_GET['inputId'] : "";
// 
$date = isset($_GET['date']) ? $_GET['date'] : "";
$month = isset($_GET['month']) ? $_GET['month'] : "";
$year = isset($_GET['year']) ? $_GET['year'] : "";
// 
if (!Output::getShifts($date, $month, $year)) {
    // 
    exit;
    // 
}
//
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
    <title>Edit Shift</title>
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
    <main id="shift-input">
        <section class="section">
            <div class="container is-fluid">
                <div class="column is-6 is-offset-3">
                    <div class="box">
                        <form action="editShiftHandling.php" method="post">
                            <div class="field">
                                <label class="label" for="date1">Shift Start Date : </label>
                                <div class="control">
                                        <input class="input" type="date" name="shiftDateStart" id="date1" min="2019-01-01" max="2050-12-31">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="shift_Start">Shift Start : </label>
                                <div class="control">
                                    <input class="input" type="time" name="shiftStart" id="shift_Start" placeholder="Shift Start">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="date2">Shift End Date :</label>
                                <div class="control">
                                    <input class="input" type="date" name="shiftDateEnd" id="date2" min="2019-01-01" max="2050-12-31">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="shift_End">Shift End : </label>
                                <div class="control">
                                    <input class="input" type="time" name="shiftEnd" id="shift_End" placeholder="Shift End">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="workplace">workplace : </label>
                                <div class="control is-extended">
                                    <div class="select is-fullwidth">
                                        <select name="workplaceId" id="workplaceId">
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
                                <label class="label" for="inputId">Shift to be edited</label>
                                <div class="control is-extended">
                                    <div class="select is-fullwidth">
                                        <select name="inputId" id="inputId">
                                            <?php
                                                foreach (Output::getShifts($date, $month, $year) as $option) :
                                            ?>
                                            <option 
                                                value="<?php echo $option['inputId'] ?>" 
                                                <?php echo ($inputId == $option['inputId']) ? "selected" : null ?> 
                                            >
                                            <?php echo $option['workplace'] . " : " . date('g:iA', strtotime($option['shiftStart'])) . " - " . date('g:iA', strtotime($option['shiftEnd'])) ?>
                                            </option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button class="button is-primary" type="submit">Submit</button>
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

