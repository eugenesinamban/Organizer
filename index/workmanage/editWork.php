<?php session_start();
try {
    // 
    // prepare files
    // 
    require_once("../../classes/Output.php");
    require_once("../../classes/Authenticate.php");
    //
    // check if DB is live
    // 
    DB::databaseConnect();
    // 
    // check if user got to the page using edit work page or details
    // 
    if (isset($_GET['inputId'])) {
        //
        $inputId = $_GET['inputId'];
        //
    } elseif (isset($_POST['inputId'])) {
        //
        $inputId = $_POST['inputId'];
        // 
    } else {
        //
        // if none, return null
        // 
        $inputId = null;
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
    header('location:./index.php?error=on');
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
    <main id="workplace-input">
        <section class="section">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column is-one-third">
                        <?php 
                        if (isset($_GET['error']) && "on" == $_GET['error']) :
                        ?>
                        <div class="has-text-danger">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php 
                        endif;
                        ?>
                        <div class="box">
                            <form action="editWorkHandling.php" method="post">
                                <div class="field">
                                    <div class="control">
                                        <input type="text" name="workplace" placeholder="Workplace" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input type="number" name="wage" placeholder="Wage" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input type="number" name="transportation" placeholder="Transportation" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                            <input type="text" name="address" placeholder="Address" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input type="text" name="contactDetails" placeholder="Contact Details" class="input"> 
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="startDate" class="label">Date Started :</label>
                                    <div class="control">
                                        <input type="date" name="startDate" id="startDate" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="savedWorkplace" class="label">Workplace to be edited:</label>
                                    <div class="control is-expanded">
                                        <div class="select is-fullwidth">
                                            <select name="inputId" id="savedWorkplace">
                                                <?php 
                                                    foreach (Output::getWorkplaces() as $workplace) :
                                                ?>
                                                <option value="<?php echo $workplace['inputId']; ?>" <?php echo ($inputId == $workplace['inputId']) ? "selected" : null; ?>><?php echo htmlspecialchars($workplace['workplace']); ?></option>
                                                <?php 
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <button type="submit" class="button is-primary">Submit</button>
                                    <a href="index.php" class="button is-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="column"></div>
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
