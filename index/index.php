<?php 

try {
    
    require_once("../bootstrap.php");
    require_once(CLASSES . "/Calendar.php");
    require_once(MODELS . "/Workplace.php");
    require_once(MODELS . "/Shift.php");
    
    // var_dump(INDEX);

    $calendar = new Calendar();
    $workplace = new Workplace();
    $shift = new Shift();
    $error = isset($_GET['error']) && "on" === $_GET['error'] ? $_SESSION['error'] : null;
    
    isset($_GET['month']) && is_numeric($_GET['month']) ? Calendar::setMonth($_GET['month']) : null;
    isset($_GET['year']) && is_numeric($_GET['year']) ? Calendar::setYear($_GET['year']) : null;

    $viewVars = [
        // 
        'calendar' => $calendar,
        'date' => [
            // 
            'month' => Calendar::getMonth(),
            'year' => Calendar::getYear(),
        ],
        'workplace' => $workplace,
        'shift' => $shift,
        'error' => $error

    ];

    echo $twig->render('index/index.twig', $viewVars);

} catch (Throwable $e) {
    // 
    $_SESSION = [];
    session_destroy();
    session_start();
    $_SESSION['error'] = $e->getMessage();
    header("location:../index.php?error=on");
    exit;
}
?>