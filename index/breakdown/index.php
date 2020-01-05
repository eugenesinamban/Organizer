<?php session_start();
//////////////////////////////////////
//                                  //
//       SHOW ANNUAL BREAKDOWN      //
//                                  //
//////////////////////////////////////
//
// 
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
    <main id="analysis">
        <section class="section">
            <div class="container is-fluid">
                <div class="field">
                    <h2 class="title is-3">Yearly Analysis</h2>
                </div>
                <form action="#" method="post">
                    <div class="field is-grouped is-grouped-centered">
                        <div class="control">
                            <div class="select">
                                <select name="year" id="year">
                                    <?php 
                                    for ($i = 2018 ; $i <= 2030 ; $i++) :
                                    ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input class="button is-black" type="submit">
                    </div>
                </form>
                <div class="column is-4 is-offset-4">
                    <div class="field">
                    <?php 
                    require_once("breakdown.php");
                    ?>
                    </div>
                </div>
                <div class="field">
                    <a href="../index.php" class="button is-primary">Home</a>
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