<?php 

session_start();

require_once('../../bootstrap.php');
require_once('../../classes/Calendar.php');
require_once('../../models/Utilities.php');

isset($_POST['year']) && is_numeric($_POST['year']) ? (Calendar::setYear($_POST['year'])) : null;

$viewVars = [

    'year' => Calendar::getYear(),
    'utilities' => new Utilities()

];

echo $twig->render('/index/breakdown.twig', $viewVars);

?>