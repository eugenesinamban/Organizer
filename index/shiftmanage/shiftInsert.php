<?php 

session_start();

require_once("../../bootstrap.php");
require_once("../../models/workplace.php");
require_once("../../classes/Calendar.php");

// set proper date values

isset($_GET['date']) && is_numeric($_GET['date']) ? Calendar::setDate($_GET['date']) : null;
isset($_GET['month']) && is_numeric($_GET['month']) ? Calendar::setMonth($_GET['month']) : null;
isset($_GET['year']) && is_numeric($_GET['year']) ? Calendar::setYear($_GET['year']) : null;

// supply date values into variables

$date = Calendar::getDate();
$month = Calendar::getMonth();
$year = Calendar::getYear();

$dateValue = date("Y-m-d", strtotime($year . "-" . $month . "-" . $date));

$viewVars = [
    // 
    'date' => [
        'date' => $date,
        'month' => $month,
        'year' => $year
    ],
    'dateValue' => $dateValue,
    'workplaces' => Workplace::getWorkplaces()
];

echo $twig->render('/index/shift/shiftInsert.twig', $viewVars);

?>
