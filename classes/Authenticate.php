<?php
//   require_once(__DIR__ . "/Output.php");
require_once(__DIR__ . "/Db.php");
// // // // // // // // // // // // //  
//                       //  
//  AUTHENTICATION CLASS //  
//                       //  
// // // // // // // // // // // // //   
class Authenticate {
    //   
    //   used for authentication such as login
    //  
    static public function getUser(string $email) {
        //  
        $sql = "    SELECT `id`, `password` 
                    FROM `user` 
                    WHERE email = :email
        ";
        //   
        $objects = [
            //  
            'email' => $email
        ];
        //  
        //  get user 
        //  
        try {
            //  
            $pdo = DB::databaseConnect();
            $fetch = $pdo->prepare($sql);
            $fetch->execute($objects);
            $user = $fetch->fetch();
            //  
            return $user;
            //  
        } catch (Exception $e) {
            //  
            throw new Exception($e->getMessage());
        }
    }
    //  
    static public function prepare(array $array) : array {
        //  
        try {
            //  
            //  check if input is empty
            //  after preparing array, check if valid input
            // 
            if (!self::inputIsValid($array)) {
                //  
                //  if invalid, it will return Exception
                // 
                throw new Exception("Input is invalid! Please try again!");
                //  
            }
            //  
            $objects = [];
            // 
            //  if valid, return trimmed
            //  prepare array
            //  
            foreach ($array as $key => $value) {
                //  
                $objects[$key] = trim($value);
                //  
            }
            //  
            //  return valid, escaped objects
            //  
            return $objects;
            //  
        } catch (Exception $e) {
            //  
            throw new Exception($e->getMessage());
        }
    }
    //  
    static public function verify(string $userEmail, string $password) : string {
        //  
        $pass = $password;
        //  
        $user = self::getUser($userEmail);
        //  
        if (!$user && false === password_verify($pass, $user['password'])) {
            //   
            //   if user does not exist, throw exception
            //   if password verification fails, throw exception
            //   
            throw new Exception("Incorrect E-mail and password combination!");
        }
        //  
        return $user['id'];
    }
    //  
    static public function login(array $loginValues) : void {
        //   
        try {
            //  
            //  check if input is empty
            //  after preparing array, check if valid input
            //  if invalid, it will return Exception
            // 
            $objects = self::prepare($loginValues);
            // 
            $id = self::verify($objects['email'], $objects['password']);
            //   
            //   if all successful, proceed with log in
            //  
            $_SESSION['id'] = $id;
            session_regenerate_id(true);
            return;
            //    
        } catch (Exception $e) {
            //   
            throw new Exception($e->getMessage());
        }
        //  
    }
    //  
    static public function hasDuplicateUser(string $email) : bool {
        //   
        //   fetch user details
        //   
        try {
            //   
            $user = self::getUser($email);
            //   
            if ($user) {
                //   
                //   if user exists, throw exception
                //   
                return True;
            }
            //   
            return False;
            //   
        } catch (Exception $e) {
            //   
            throw new Exception($e->getMessage());
        }
    }
    //  
    static public function logout() : void {
        //   
        $_SESSION = [];
        session_destroy();
        //  
    }
    //  
    static public function inputIsValid(array $input) : bool {
        //  
        //   used to check if input is valid
        //   
        if ([] === $input) {
            //  
            return False;
        }
        //  
        foreach ($input as $value) {
            //  
            if ("" === trim($value) && null !== $value) {
                //  
                return False;
            }
        }
        //  
        return True;
    }
}

?>

