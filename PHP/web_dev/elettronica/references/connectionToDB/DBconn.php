<?php
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
                echo 'sono stati riscontrati problemi nella connessione al database';
            }
        }
        return self::$db;
    }

}