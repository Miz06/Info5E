<?php
ob_start();
$title = 'login';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * FROM eventi'
?>

<?php require '../references/footer.php' ?>