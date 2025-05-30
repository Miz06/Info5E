<?php
class DbConn
{
    private static PDO $db;
    public static function getDB(): PDO
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO("mysql:host=localhost;dbname=registroscuola2", "root", "",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$db;
    }
}