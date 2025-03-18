<?php
function logError(PDOException $e): void
{
    error_log($e->getMessage().'---'.date('Y-m-d H:i:s'."\n"), 3,'../log/DB_Errors_log');
}