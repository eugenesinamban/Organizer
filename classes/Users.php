<?php 
require_once(__DIR__ . "/../models/InputModel.php");
////////////////
//            //
// USER CLASS //
//            //
////////////////
class Users extends InputModel {
    //
    //Users class is used for adding users, searching users, deleting users.
    //
    static protected $table = "`user`";
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
    static public function insert(array $array) : void {
        // 
        try {
            // prepare keys for parsing and respective array objects
            // after checking if input is valid
            // 
            $objects = self::prepare($array);
            // 
            if (Authenticate::hasDuplicateUser($objects['email'])) {
                // 
                // checks for duplicate user
                // 
                throw new Exception("Duplicate user detected!");
                // 
            }
            // 
            $objects['password'] = password_hash($objects['password'], PASSWORD_DEFAULT);
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
    static public function update(array $objects) : void {
        try {
            //
            // prepare input for parsing and respective array a=objects
            //
            $keys = array_keys($objects);
            //
            $placeholder = [];
            //
            // parse
            //
            foreach ($keys as $key) {
                //
                $placeholder[] = "`{$key}` = :{$key}";
            }
            //
            $UserId = array_pop($placeholder);
            //
            $sql = "    UPDATE " . static::$table . "
                        SET " . implode(',', $placeholder) . "
                        WHERE {$UserId}
            ";
            // 
            //  
            // update line, then get affected row count
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
    static public function delete(array $objects) : void {
        try {
            // 
            $objects = self::prepare($objects);
            // 
            // verify if user is valid
            // 
            $id = Authenticate::verify($objects['email'], $objects['password']);
            // 
            if ($id !== $_SESSION['id']) {
                // 
                throw new Exception("Incorrect E-mail and password combination!");
            }
            // 
            // once verification is complete, proceed with delete
            // 
            $keys = array_keys($objects);
            $placeholder = [];
            //
            // create placeholder
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
            return ;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    // 
    static public function addUserId(array $objects) : array {
        //
        $objects['id'] = $_SESSION['id'];
        //
        return $objects;
        //   
    }
}
?>


