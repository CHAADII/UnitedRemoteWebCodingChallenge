<?php



class MysqlSing
{
    private static $_instance = null;
    public static $con = null;

    public static function getInstance() {
        global $_datasrc;

        try {
            if (self::$_instance === null) {
                // mongodb://username:password@host:port/databasename
                $dsn = "mysql:host=".$_datasrc["host"].";dbname=".$_datasrc["db_name"].";charset=".$_datasrc["charset"]."";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
                    //PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                self::$con = new PDO($dsn, $_datasrc['username'], $_datasrc['password'], $options);
            }
            return self::$_instance;
        } catch (PDOException $e) {

            if( _VERBOSE )
                throw new \PDOException("An error occurred while connecting to the database.".$e->getMessage(), $e->getCode());
            die("Exception");

        }
    }
}

?>