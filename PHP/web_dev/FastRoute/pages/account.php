<?php
$title = 'account';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryUpdatePassword = 'UPDATE db_FastRoute;personale SET password = :password WHERE email = :email';
$querySelectUserData = 'SELECT * FROM db_FastRoute.personale WHERE email = :email';

try{
    $stm = $db->prepare($querySelectUserData);
    $stm->bindValue(':email', $_SESSION['email']);
    $stm->execute();

    $userData = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();
}catch(Exception $e){
    logError($e);
}

?>

<p><strong>Nome: </strong> <?=$userData['nome']?></p>
<p><strong>Email: </strong> <?=$userData['email']?></p>
<p><strong>Città: </strong> <?=$userData['citta']?></p>
<p><strong>Via: </strong> <?=$userData['via']?></p>
<hr><br>

<h4>Desideri cambiare password?</h4>
<p>[È prima necessario inserire la password in uso]</p>
<form method="post" action="account.php">
    <label for="password_attuale"><strong>Password attuale</strong></label>
    <input type="password" name="password_attuale" id="password_attuale" required>
    <input type="submit" value="Submit">
    <hr>
</form>


