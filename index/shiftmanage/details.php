<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Shift.php");

$date = $_GET['date'] ?? null;
$month = $_GET['month'] ?? null;
$year = $_GET['year'] ?? null;

$viewVars = [

    'date' => [

        'date' => $date,
        'month' => $month,
        'year' => $year

    ],
    'shifts' => Shift::fetchShifts($date, $month, $year)

];

echo $twig->render("/index/shift/shiftDetail.twig", $viewVars)

?>
