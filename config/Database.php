<?php

//database connection configuration

abstract class Database
{
    static $connection;
    public static function connect(): ?object
    {
        try {
            if (empty($connection)) {

                $sdn = 'mysql:host=localhost;dbname=elzikrayat;charset=utf8mb4';
                self::$connection = new PDO($sdn, 'root', '');
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if (self::$connection) {
                    // echo "<h1> connected</h1>";
                }
            }
        } catch (PDOException $err) {
            echo self::$connection;
            echo ('couldnt connect to database: ' . $err->getMessage());
            return self::$connection;
        }

        return self::$connection;
    }
}
