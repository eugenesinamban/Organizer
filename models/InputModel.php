<?php 
require_once(__DIR__ . "/../classes/Authenticate.php");
//
class InputModel {
    //
    // class for shifts
    // Program uses this class to add, edit, and delete data from DB
    //
    static protected $table;
    //
    //////////////////////////////////////////////////
    //                                              //
    //          Prepare -> check if valid then      //
    //              escape values                   //
    //                                              //
    //////////////////////////////////////////////////
    //
    static public function prepare(array $array) : array {
        // 
        try {
            // 
            // check if input is empty
            // after preparing array, check if valid input
            //
            if (false === Authenticate::inputIsValid($array)) {
                // 
                throw new Exception("Input is invalid!");
                // 
            }
            //
            // if invalid, it will return Exception
            //
            $objects = [];
            //
            // if valid, return trimmed
            // prepare array
            // 
            foreach ($array as $key => $value) {
                //
                $objects[$key] = trim($value);
                //
            }
            //
            $objects = self::addUserId($objects);
            // 
            // return valid, escaped objects
            //
            return $objects;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function updatePrepare(array $array) : array {
        // 
        try {
            // 
            // check if input is empty
            // if empty, return null for each object
            //
            $objects = [];
            //
            foreach ($array as $key => $value) {
                //
                // if value is not empty,
                // 
                if ("" !== $value) {
                    // 
                    // place trimmed values inside objects
                    // 
                    $objects[$key] =  trim($value);
                }
            }
            //
            // after preparing array, check if valid input
            //
            if (false === Authenticate::inputIsValid($objects)) {
                // 
                throw new Exception("Input is invalid!");
            }
            //
            $objects = self::addUserId($objects);
            // 
            // return valid, escaped objects
            // 
            return $objects;
            //
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    //////////////////////////////////////////////////
    //                                              //
    //               Input part                     //
    //                                              //
    //////////////////////////////////////////////////
    //
    static public function encode(string $sql, array $array) : void {
        //
        // used to insert new users
        // 
        try {
            // 
            $pdo = DB::databaseConnect();
            $pdo->beginTransaction();
            $pdo->prepare($sql)->execute($array);
            $pdo->commit();
            // 
        } catch (Exception $e) {
            // 
            // rollback on failure, then send message
            // 
            $pdo->rollBack();
            error_log($e->getMessage());
            throw new Exception("Unexpected error! Please try again!");
            //
        }
        // 
        return;
    }
    //
    static public function insert(array $array) : void {
        //
        try {
            // 
            // prepare keys for parsing and respective array objects
            // after checking if input is valid
            // 
            $objects = self::prepare($array);
            // 
            $keys = array_keys($objects);
            $values = [];
            $columns = [];
            //
            // parse
            //
            foreach ($keys as $key) {
                //
                $values[] = ":{$key}";
                $columns[] = "`{$key}`";
            }
            //
            $sql = "    INSERT
                        INTO " . static::$table . " (" . implode(',', $columns) . ")
                        VALUES (" . implode(',', $values) .")
            ";
            // 
            self::encode($sql, $objects);
            // 
            return;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    //
    static public function update(array $array) : void {
        // 
        try {
            //
            // prepare input for parsing and respective array objects
            // 
            $objects = self::updatePrepare($array);
            // 
            $keys = array_keys($objects);
            // 
            $placeholder = [];
            //
            // Parse
            //
            foreach ($keys as $key) {
                //
                $placeholder[] = "`{$key}` = :{$key}";
            }
            //
            $UserId = array_pop($placeholder);
            $inputId = array_pop($placeholder);
            //
            // prepare sql
            //
            if (count($placeholder) <= 0) {
                // 
                // if placeholder is empty, return false
                // 
                throw new Exception("Please enter correct value!");
                //
            }
            // 
            $sql = "    UPDATE " . static::$table . "
                        SET " . implode(',', $placeholder) . "
                        WHERE {$inputId}
                        AND {$UserId}
            ";
            //
            // update line, then get affected row count
            // 
            // 
            $pdo = DB::databaseConnect();
            //
            $send = $pdo->prepare($sql);
            $send->execute($objects);
            $receive = $send->rowCount();
            //
            // if affected row count is 0, return false
            //
            if (0 === $receive) {
                //
                throw new Exception("Update failed, please try again!");
            }
            // 
            return;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }    
    //
    static public function delete(array $array) : void {
        try {
            // 
            // prepare placeholder
            // 
            $objects = self::prepare($array);
            // 
            // add user id for WHERE query
            // 
            $keys = array_keys($objects);
            $placeholder = [];
            //
            // Parse
            //
            foreach ($keys as $key) {
                //
                $placeholder[] = "`{$key}` = :{$key}";
            }
            //
            // prepare SQL
            //
            $sql = "    DELETE
                        FROM " . static::$table . "
                        WHERE " . implode(' AND ', $placeholder)
            ;
            //
            // delete line, then get affected row count
            //
            $pdo = DB::databaseConnect();
            //
            $send = $pdo->prepare($sql);
            $send->execute($objects);
            $receive = $send->rowCount();
            //
            // if affected row count is 0, return false
            //
            if (0 === $receive) {
                //
                throw new Exception("Delete failed, please try again!");
            }
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
        //
        return;
    }
    //
    static public function addUserId(array $objects) : array {
        //
        $objects['userId'] = $_SESSION['id'];
        //
        return $objects;
        //   
    }
    //
}
?>

