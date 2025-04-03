<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: ../pages/account.php");
