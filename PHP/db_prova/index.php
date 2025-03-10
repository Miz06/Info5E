<?php
require './db_connection/DBconn.php';
$config = require './db_connection/databaseConfig.php';
$db = DBconn::getDB($config);

function randomDate($startDate, $endDate)
{
    return date('Y-m-d', mt_rand(strtotime($startDate), strtotime($endDate)));
}


$queryInsert = 'INSERT INTO db_prova.testpunti (data) VALUES (:data)';
$queryUpdate = 'UPDATE db_prova.testpunti SET boolean = 0 where boolean = 1 LIMIT ';
$queryOrderDate = 'ALTER TABLE db_prova.testpunti ORDER BY data ASC';
$queryCount = 'SELECT count(*) FROM db_prova.testpunti t WHERE t.boolean = 1';
$querySelect = 'SELECT * FROM db_prova.testpunti t WHERE t.boolean = 1';

$stmt = $db->prepare($queryCount);
$stmt->execute();
$max = $stmt->fetchColumn();
$stmt->closeCursor();

$stmt = $db->prepare($queryOrderDate);
$stmt->execute();
$stmt->closeCursor();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = '2020-01-01';
    $endDate = '2023-12-31';
    $randomDate = randomDate($startDate, $endDate);
    $N = $_POST['N'] ?? 0;

    if (isset($_POST['inserisci'])) {
        $stmt = $db->prepare($queryInsert);
        $stmt->bindValue(':data', $randomDate);
        $stmt->execute();
        $stmt->closeCursor();
    } elseif (isset($_POST['aggiorna'])) {
        $stmt = $db->prepare($queryUpdate . $N);
        $stmt->execute();
        $stmt->closeCursor();
    }

    header('Location: index.php');
}
?>

<form method="post" action="index.php">
    <input type="submit" name="inserisci" class="submit-button" value="Inserisci">
    <br>
    <hr>

    <?php
    try {
        $stm = $db->prepare($querySelect);
        $stm->execute();
        while ($element = $stm->fetch()) {
            echo $element->data . '    ~    ' . $element->boolean . '<br>';
        }
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
    ?>

    <hr>
    <label for="N"><strong>Value (N):</strong></label>
    <input type="number" id="N" name="N" min="0" max="<?= $max ?>">
    <br>

    <input type="submit" name="aggiorna" class="submit-button" value="Aggiorna">
</form>
