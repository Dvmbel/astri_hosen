<?php

class Database
{
    private static $dbName = 'astri_hosen';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $conn = null;

    public function __construct()
    {
        exit('Init function is not allowed');
    }

    public static function connect()
    {
        if (null == self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName . ';charset=utf8mb4', self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }
}

?>
