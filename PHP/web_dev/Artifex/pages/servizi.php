<?php
ob_start();
$title = 'Servizi';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);
?>


<?php require '../references/footer.php'; ?>
