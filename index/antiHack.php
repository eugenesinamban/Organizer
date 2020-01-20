<?php
if(False === isset($_SESSION['auth']['id'])) {
    $_SESSION['error'] = "Please sign in properly!";
    header("location:/organizer-breakable/index.php?error=on");
    exit();
}

?>