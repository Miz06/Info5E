<?php
function logError(PDOException $e): void
{
    error_log($e->getMessage(), 3, 'log/DB_Errors_log');
}

class DBconn
{
    private static PDO $db;

    public static function getDB(array $config): PDO
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO($config['dns'], $config['username'], $config['password'], $config['options']);
            } catch (PDOException $e) {
                logError($e);
            }
        }
        return self::$db;
    }

}