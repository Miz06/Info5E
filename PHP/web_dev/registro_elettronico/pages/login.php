<?php
ob_start();
$title = 'login';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectPersona = "SELECT * FROM persone WHERE username = :username";

if (isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $stm = $db->prepare($querySelectPersona);
        $stm->bindValue(':username', $_POST['username']);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        if ($data && password_verify($_POST['password'], $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['nome'] = $data['nome'];
            $_SESSION['cognome'] = $data['cognome'];

            setcookie('username', $data['username'], time()+3600, '/');
            setcookie('nome', $data['nome'], time()+3600, '/');
            setcookie('cognome', $data['cognome'], time()+3600, '/');

            header('Location: ./account.php');
        }
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}
ob_end_flush();
?>

    <form action="login.php" method="post">
        <div class="container">
            <h4>Effettua il login:</h4><br>
            <label for="username"><strong>Username</strong></label>
            <input type="text" id="username" name="username" required>
            <hr>
            <br>

            <label for="password"><strong>Password</strong></label>
            <input type="password" id="password" name="password" required>
            <hr>
            <br>

            <div class="submit-container">
                <input type="submit" value="Effettua login">
            </div>
        </div>
    </form>

<?php require '../references/footer.php' ?>