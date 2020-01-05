<?php session_start();
require_once("../../classes/Output.php");
//
$date = isset($_GET['date']) ? $_GET['date'] : "";
$month =isset($_GET['month']) ? $_GET['month'] : "";
$year =isset($_GET['year']) ? $_GET['year'] : "";
//
if (false === Output::getShifts($date, $month, $year)) {
    // 
    ?>
    <script>
        self.close();
    </script>
    <?php
    echo "no shift";    
    exit;
    // 
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
    <script>
        //
        
    </script>
    <title>Details</title>
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
    <main id="details-shift">
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-one-third is-offset-one-third">
                        <h2 class="title is-3"><?php echo date("Y-m-d", strtotime($year . ", " . $month . " " . $date)); ?></h2>
                        <div class="field">
                            <?php
                            foreach (Output::getShifts($date, $month, $year) as $shift) :
                            ?>
                            <table class="table is-striped is-bordered">
                                <tr>
                                    <td>Shift</td>
                                    <td><?php echo date('g:ia', strtotime($shift['shiftStart'])) . " - " . date('g:ia', strtotime($shift['shiftEnd'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Workplace</td>
                                    <td><?php echo $shift['workplace']; ?></td>
                                </tr>
                                <tr>
                                    <td>Wage</td>
                                    <td><?php echo $shift['wage']; ?></td>
                                </tr>
                                <tr>
                                    <td>Transportation Allowance</td>
                                    <td><?php echo $shift['transportation']; ?></td>
                                </tr>
                            </table>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <form action="deleteShiftHandling.php" method="post">
                    <div class="field">
                        <a href="editShift.php?date=<?php echo $date;?>&month=<?php echo $month; ?>&year=<?php echo $year;?>&inputId=<?php echo $shift['inputId']; ?>" class="button is-warning">Edit Shift</a>
                        <button class="button is-danger" type="submit" name="inputId" value="<?php echo $shift['inputId'] ?>">Delete Shift</button>
                    </div>
                </form>
                <div class="field">
                    <a href="addShift.php?date=<?php echo $date;?>&month=<?php echo $month; ?>&year=<?php echo $year;?>" class="button is-info">Add Shift</a>
                    <button onclick="parent.window.close();" class="button is-primary">Back</button>
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