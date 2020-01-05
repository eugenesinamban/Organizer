<?php
require_once(__DIR__ . "/Db.php");
//
class Output {
    //
    // used for db data manipulation such as input, update, and deletion.
    //
    static public function fetchDatum(string $sql, array $objects) {
        //
        // used to fetch data via fetch
        //
        try {
            // 
            $pdo = DB::databaseConnect();
            $fetch = $pdo->prepare($sql);
            $fetch->execute($objects);
            $show = $fetch->fetch();
            // 
            return $show;    
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function fetchData(string $sql, array $objects) {
        //
        // used to fetch data via fetch
        //
        try {
            // 
            $pdo = DB::databaseConnect();
            $fetch = $pdo->prepare($sql);
            $fetch->execute($objects);
            $show = $fetch->fetchAll();
            // 
            return $show;    
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function getWorkplaces() {
        try {
            //
            $sql = "    SELECT *
                        FROM `userworkplace`
                        WHERE `userId` = :userId
            ";
            //
            $objects = [
                'userId' => $_SESSION['id']
            ];
            //
            // 
            $workplaces = self::fetchData($sql, $objects);
            // 
            if ([] === $workplaces) {
                // 
                return False;
            }
            // 
            return $workplaces;
            // 
        } catch (Throwable $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function getWorkplace($inputId) {
        //
        try {
            $sql = "    SELECT *
                        FROM `userworkplace`
                        WHERE `userId` = :userId
                        AND `inputId` = :inputId
            ";
            //
            $objects = [
                //
                'inputId' => $inputId,
                'userId' => $_SESSION['id']
            ];
            //
            $workplaces = self::fetchDatum($sql, $objects);
            // 
            return $workplaces;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
            // 
        }
    }
    //
    static public function getSalary($month ,$year) {
        // 
        try {
            //
            // get monthly salary
            //
            $salary = 0;
            $totalHours = 0;
            //
            $sql = "    SELECT `workplaceId`, `shiftDateStart`, `shiftStart`, `shiftDateEnd`, `shiftEnd`, `calendar`.`userId`, `userworkplace`.`wage`, `userworkplace`.`transportation`
                        FROM `calendar`
                        LEFT JOIN `userworkplace`
                        ON calendar.workplaceId = userworkplace.inputId
                        WHERE YEAR(`calendar`.`shiftDateStart`) = :Year
                        AND MONTH(`calendar`.`shiftDateStart`) = :Month
                        AND `calendar`.`userId` = :userId
                        ORDER BY `calendar`.`shiftDateStart`
            ";
            //
            $objects = [
                //
                'Month' => $month,
                'Year' => $year,
                'userId' => $_SESSION['id']
            ];
            //
            $totals = self::fetchData($sql, $objects);
            // 
            return $totals;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function getShifts($date, $month, $year) {
        //
        try {
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
            return $shifts;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    // 
    static public function hasShift() : bool {
        // 
        try {
            // 
            $sql = "    SELECT `inputId`
                        FROM `calendar`
                        WHERE `userId` = :userId
            ";
            // 
            $objects = [
                // 
                'userId' => $_SESSION['id']
    
            ];
            // 
            $shifts = self::fetchDatum($sql, $objects);
            // 
            if (false === $shifts) {
                // 
                return False;
            } 
            // 
            return True;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
            // 
        }

    }
    // 
    static public function fetchUserDetails() {
        try {
            //
            // fetch all user details using ID
            //
            $sql = "    SELECT `email`, `lastName`,`firstName` 
                        FROM `user` 
                        WHERE id = :id
            ";
            //
            $objects = [
                //
                'id' => $_SESSION['id']
            ];
            //
            $user = self::fetchDatum($sql, $objects);
            // 
            return $user;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function fetchUser($id) {
        try {
            // 
            //
            // fetch user ID from DB
            //
            $sql = "    SELECT * 
                        FROM `user` 
                        WHERE email = :email
            ";
            $objects = [
                'email' => $id
            ];
            // 
            $user = self::fetchDatum($sql, $objects);
            // 
            return $user;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function fetchPassword() {
        // 
        try {
            // 
            $sql = "    SELECT `password`
                        FROM `user`
                        WHERE `id` = :id
            ";
            // 
            $objects = [
                //
                'id' => $_SESSION['id']
            ];
            // 
            $datum = self::fetchDatum($sql, $objects);
            // 
            return $datum;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
}
?>

