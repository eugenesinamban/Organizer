<?php 

session_start();

require_once("../../bootstrap.php");
require_once("../../classes/Calendar.php");
require_once("../../models/Shift.php");
require_once("../../models/Workplace.php");

$inputId = $_GET['inputId'];

isset($_GET['date']) && "" !== $_GET['date'] ? Calendar::setDate($_GET['date']) : null;
isset($_GET['month']) && "" !== $_GET['month'] ? Calendar::setMonth($_GET['month']) : null;
isset($_GET['year']) && "" !== $_GET['year'] ? Calendar::setYear($_GET['year']) : null;

$date = Calendar::getDate();
$month = Calendar::getMonth();
$year = Calendar::getYear();


$viewVars = [

    'date' => [
        'date' => $date,
        'month' => $month,
        'year' => $year
    ],
    'workplaces' => Workplace::getWorkplaces(),
    'shifts' => Shift::fetchShifts($date, $month, $year),
    'inputId' => $inputId

];

echo $twig->render("/index/shift/shiftUpdate.twig", $viewVars);

?>
