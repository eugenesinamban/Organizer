<?php 

require_once("../../bootstrap.php");
require_once(MODELS . "/Shift.php");
require_once(CLASSES . "/Compute.php");

$date = $_GET['date'] ?? null;
$month = $_GET['month'] ?? null;
$year = $_GET['year'] ?? null;
$shifts = Shift::fetchShifts($date, $month, $year);
$compute = new Compute();

$viewVars = [

    'date' => [

        'date' => $date,
        'month' => $month,
        'year' => $year

    ],
    'shifts' => $shifts,
    'compute' => $compute

];

echo $twig->render("/index/shift/shiftDetail.twig", $viewVars)

?>
