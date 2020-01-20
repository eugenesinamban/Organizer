<?php
require_once(__DIR__ . "/AppModel.php");
//
class Utilities extends AppModel{
    
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

    static public function getMonthlyTotals($month ,$year) {
        
        // get monthly salary and work hours

        $return = [

            'salary' => 0,
            'totalHours' => 0

        ];

        $sql = "    SELECT `workplaceId`, `shiftDateStart`, `shiftStart`, `shiftDateEnd`, `shiftEnd`, `calendar`.`userId`, `userworkplace`.`wage`, `userworkplace`.`transportation`
                    FROM `calendar`
                    LEFT JOIN `userworkplace`
                    ON calendar.workplaceId = userworkplace.inputId
                    WHERE YEAR(`calendar`.`shiftDateStart`) = :Year
                    AND MONTH(`calendar`.`shiftDateStart`) = :Month
                    AND `calendar`.`userId` = :userId
                    ORDER BY `calendar`.`shiftDateStart`
        ";
        
        $objects = [
            //
            'Month' => $month,
            'Year' => $year,
            'userId' => $_SESSION['auth']['id']
        ];
        
        $shifts = self::fetchData($sql, $objects);
        
        if (!$shifts) {
            // 
            // return false if no values
            // 
            return null;
        }

        foreach ($shifts as $shift) {

            $totalTime = self::totalTime($shift);

            $return['salary'] += ($totalTime * $shift['wage']) + $shift['transportation'];

            $return['totalHours'] += $totalTime;
            
        }

        return $return;
        
    }
    //
    static public function getShifts($date, $month, $year) : ?array {
        //
        $select = "
            `calendar`.`inputId`,
            `shiftDateStart`,
            `shiftStart`,
            `shiftDateEnd`,
            `shiftEnd`,
            `calendar`.`userId`,
            `workplaceId`,
            `userworkplace`.`workplace`,
            `userworkplace`.`wage`,
            `userworkplace`.`transportation`
        ";
        //
        $sql = "    SELECT $select
                    FROM `calendar` 
                    LEFT JOIN `userworkplace` 
                    ON calendar.workplaceId = userworkplace.inputId 
                    WHERE DAY(`calendar`.`shiftDateStart`) = :currentDay
                    AND MONTH(`calendar`.`shiftDateStart`) = :currentMonth
                    AND YEAR(`calendar`.`shiftDateStart`) = :currentYear
                    AND `calendar`.`userId` = :userId
                    ORDER BY `calendar`.`shiftStart`
        ";
        //
        $month = date('m', strtotime($month));
        $objects = [
            //
            'currentDay' => $date,
            'currentMonth' => $month,
            'currentYear' => $year,
            'userId' => $_SESSION['id']
            //
        ];
        //
        $shifts = self::fetchData($sql, $objects);
        // 
        return $shifts ?: Null;
    }
}
?>
