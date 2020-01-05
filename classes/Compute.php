<?php 

class Compute {
    // 
    //for used to compute for time and such
    // 
    static public function totalTime(array $objects) : string {
        //
        // prepare objects
        // 
        $dateStart = $objects['shiftDateStart'];
        $timeStart = $objects['shiftStart'];
        $dateEnd = $objects['shiftDateEnd'];
        $timeEnd = $objects['shiftEnd'];
        // 
        $totalStart = date("Y-M-d H:i", strtotime("$dateStart $timeStart"));
        $totalEnd = date("Y-M-d H:i", strtotime("$dateEnd $timeEnd"));
        $totaltime = (strtotime($totalEnd) - strtotime($totalStart)) / 60 / 60;
        // 
        return $totaltime;
        // 
    }
}

?>
