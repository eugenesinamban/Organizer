<?php 

require_once(__DIR__ . "/AppModel.php");

class AccessToken extends AppModel {
    
    protected static $table = "`accesstoken`";

    protected static $keys = '`token`';

    public static function isValid() : bool {

        $token = self::findBy(['userId' => $_SESSION['auth']['id']]);
        
        if ($token['log'] > time()) {

            return True;

        }

        // else

        return False;

    }

    public static function clear() : void {

        try {

            self::delete(['userId' => $_SESSION['auth']['id']]);

        } catch (Exception $e) {

            throw $e;

        }

    }

    public static function clearAll() : void {

        try {

            $pdo = DB::databaseConnect();
            
            $sql = "    DELETE FROM " . self::$table .
                    "   WHERE `log` < " . time();

            $pdo->prepare($sql)->execute();

        } catch (Exception $e) {

            throw $e;

        }

    }

}

?>