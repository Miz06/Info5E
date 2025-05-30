<?php
require 'DbConn.php';
$cf=$_POST['cf'] ?? '';
$nome=$_POST['nome'] ?? '';
$cognome=$_POST['cognome'] ?? '';
$dataDiNascita=$_POST['dataDiNascita'] ?? '';
$residenza=$_POST['residenza'] ?? '';
$telefono=$_POST['telefono'] ?? '';
$matricola=$_POST['matricola'] ?? '';
$indirizzo=$_POST['indirizzo'] ?? '';
$media = $_POST['media'] ?? '';

/*
$fields = ['nome', 'cognome', 'dataDiNascita', 'residenza', 'telefono', 'matricola', 'indirizzo', 'media'];
$data = [];
foreach ($fields as $field) {
$data[$field] = $_POST[$field] ?? '';
}
*/

// Connect to the database

$pdo= DBConn::getDB();
// Start transaction
$pdo->beginTransaction();
try {
// Step 1: Insert into Persone
    $stmt = $pdo->prepare("INSERT INTO Persone (cf,nome, cognome,dataDiNascita,residenza,telefono) VALUES (:cf,:nome, :cognome, :dataDiNascita, :residenza,:telefono)");
    $stmt->bindValue(':cf', $cf);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cognome', $cognome);
    $stmt->bindValue(':dataDiNascita', $dataDiNascita);
    $stmt->bindValue(':residenza', $residenza);
    $stmt->bindValue(':telefono', $telefono);
    $stmt->execute();
// Get the ID of the inserted person
    $affectedRow = $stmt->rowCount();
    if($affectedRow ==0)
        throw new Exception();
// Step 2: Insert into Studenti using the same ID
    $stmt = $pdo->prepare("INSERT INTO Studenti (cf,matricola, indirizzo,media) VALUES (:cf,:matricola, :indirizzo, :media)");
    $stmt->bindValue(':cf', $cf);
    $stmt->bindValue(':matricola', $matricola);
    $stmt->bindValue(':indirizzo', $indirizzo);
    $stmt->bindValue(':media', $media);
    $stmt->execute();
// Commit transaction
    $pdo->commit();
    header('Location:home.php');
} catch (Exception $e) {
// Rollback on error
    $pdo->rollback();
    $error= htmlspecialchars($e->getMessage());
    header("Location:home.php?error=$error");
}
?>