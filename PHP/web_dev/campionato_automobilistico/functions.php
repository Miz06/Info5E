<?php
function logError(PDOException $e): void
{
    error_log($e->getMessage(), 3, 'log/database_log');
}