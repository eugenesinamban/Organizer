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
    <script>
        // JavaScript popup window function
        function basicPopup(url) {
            //`
            popupWindow = window.open(  url,
                                        'popUpWindow',
                                        'height=600,width=400,left=50,top=50,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
        }
        //
    </script>
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
    <main id="work">
        <section class="section">
            <div class="container has-text-centered">
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
                    <div class="column is-three-fifths is-offset-one-fifth">
                        <h2 class="title is-3">Workplaces Saved</h2>
                        <table class="table is-bordered is-striped is-fullwidth">
                            <tr>
                                <th><div class="is-size-7-touch">Workplace</div></th>
                                <th><div class="is-size-7-touch">Edit</div></th>
                                <th><div class="is-size-7-touch">Delete</div></th>
                            </tr>
                        <?php 
                            if (Output::getWorkplaces()) :
                                foreach (Output::getWorkplaces() as $workplace) :
                        ?>
                            <tr class="is-hidden-touch">
                                <td class="workplace">
                                    <a href="details.php?inputId=<?php echo htmlspecialchars($workplace['inputId']) ?>" onclick="basicPopup(this.href);return false">
                                        <div class="is-size-5">
                                            <?php echo strlen($workplace['workplace'] >= 12) ? htmlspecialchars(substr($workplace['workplace'], 0, 12)) : htmlspecialchars($workplace['workplace']);  ?>
                                        </div>
                                    </a>
                                </td>
                                <td class="editDelete">
                                    <form action="editWork.php" method="post">
                                        <button id="edit-button" type="submit" name="inputId" value="<?php echo htmlspecialchars($workplace['inputId']); ?>"><img src="https://image.flaticon.com/icons/svg/61/61456.svg"></button>
                                    </form>
                                </td>
                                <td class="editDelete">
                                    <form action="deleteWorkHandling.php" method="post">
                                        <button type="submit" name="inputId" value="<?php echo htmlspecialchars($workplace['inputId']); ?>" class="delete is-medium"></button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="is-hidden-desktop">
                                <td class="workplace">
                                    <a href="details.php?inputId=<?php echo htmlspecialchars($workplace['inputId']) ?>" onclick="basicPopup(this.href);return false"><div class="is-size-7-touch is-size-5-desktop"><?php echo (strlen($workplace['workplace']) >= 12) ? htmlspecialchars(substr($workplace['workplace'], 0, 12)) . "..." : htmlspecialchars($workplace['workplace']); ?></div></a></td>
                                <td class="editDelete">
                                    <form action="editWork.php" method="post">
                                        <button id="edit-button" type="submit" name="inputId" value="<?php echo htmlspecialchars($workplace['inputId']); ?>">
                                            <img src="https://image.flaticon.com/icons/svg/61/61456.svg">
                                        </button>
                                    </form>
                                </td>
                                <td class="editDelete">
                                    <form action="deleteWorkHandling.php" method="post">
                                        <button type="submit" name="inputId" value="<?php echo htmlspecialchars($workplace['inputId']); ?>" class="delete is-medium"></button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                                endforeach;
                            endif;
                        ?>
                            <tr>
                                <td colspan="5"><a href="addWork.php" class="button is-info">Add Workplace</a></td>
                            </tr>
                        </table>
                        <a href="../index.php" class="button is-primary">Home</a>
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