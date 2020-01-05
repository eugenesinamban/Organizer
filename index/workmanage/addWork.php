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
                        <div class="box">
                            <form action="addWorkHandling.php" method="post">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="workplace" placeholder="Workplace" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                            <input class="input" type="number" name="wage" placeholder="Wage" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="number" name="transportation" placeholder="Transportation" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                            <input class="input" type="text" name="address" placeholder="Address" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="contactDetails" placeholder="Contact Details" required> <br>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="startDate">Date Started :</label>
                                    <div class="control">
                                        <input class="input" type="date" name="startDate" id="startDate" required><br>
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
