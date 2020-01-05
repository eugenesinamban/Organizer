<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../classes/Output.php");
    //
    // check if DB is live
    DB::databaseConnect();
    // 
    // show details depending on the inputId
    // 
    $inputId = $_GET['inputId'];
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
        function editWorkplaceFromPop(inputId) {
            //
            var url = "editWork.php?inputId=" + inputId;
            window.opener.location = url;
        }
        //
        
        <?php 
            if (!Output::getWorkplace($inputId)) :
        ?>
        parent.window.close();
        <?php
            endif;
        ?>
    </script>
    <title>Details</title>
</head>
<body>
    <header>
        <section class="hero">
            <div class="hero-body">
                <h1 class="title is-1"><a href="#">Organizer</a></h1>
                <div class="line"></div>
            </div>
        </section>
    </header>
    <main id="details-workplace">
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column is-one-third">
                        <?php
                            $workplace = Output::getWorkplace($inputId);
                        ?>
                        <table class="table is-striped">
                            <tr>
                                <td>Workplace Name :</td>
                                <td><?php echo htmlspecialchars($workplace['workplace'], ENT_QUOTES); ?></td>
                            </tr>
                            <tr>
                                <td>Hourly Wage :</td>
                                <td><?php echo htmlspecialchars($workplace['wage'], ENT_QUOTES); ?></td>
                            </tr>
                            <tr>
                                <td>Transportation Allowance :</td>
                                <td><?php echo htmlspecialchars($workplace['transportation'], ENT_QUOTES); ?></td>
                            </tr>
                            <tr>
                                <td>Address :</td>
                                <td><?php echo htmlspecialchars($workplace['address'], ENT_QUOTES); ?></td>
                            </tr>
                            <tr>
                                <td>Contact Details :</td>
                                <td><?php echo htmlspecialchars($workplace['contactDetails'], ENT_QUOTES); ?></td>
                            </tr>
                            <tr>
                                <td>Date Started :</td>
                                <td><?php echo htmlspecialchars($workplace['startDate'], ENT_QUOTES); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="column"></div>
                </div>
                <form action="deleteWorkPopHandling.php" method="post">
                    <div class="field">    
                        <button onclick="editWorkplaceFromPop(<?php echo $inputId; ?>); parent.window.close();" class="button is-warning">Edit Workplace</button>
                        <button class="button is-danger" type="submit" name="inputId" value="<?php echo $inputId; ?>">Delete Workplace</button>
                        <button class="button is-primary" onclick="parent.window.close();">Back</button>
                    </div>
                </form>
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