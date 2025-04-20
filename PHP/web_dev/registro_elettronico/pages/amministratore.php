<?php
$title = 'login - amministratore';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectAmministratore = "SELECT * FROM amministratori WHERE nome=:nome AND cognome=:cognome AND username=:username";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nome']) && isset($_POST['cognome'])) {
    try {
        $stm = $db->prepare($querySelectAmministratore);
        $stm->bindValue(':nome', $_POST['nome']);
        $stm->bindValue(':cognome', $_POST['cognome']);
        $stm->bindValue(':username', $_POST['username']);
        $stm->execute();
        $data = $stm->fetchColumn();
        if ($data && password_verify($_POST['password'], $data['password'])) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['cognome'] = $_POST['cognome'];

            setcookie('username', $_POST['username'], time()+3600, '/');
            setcookie('nome', $_POST['nome'], time()+3600, '/');
            setcookie('cognome', $_POST['cognome'], time()+3600, '/');

            header('Location: ./account.php');
        }
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}
?>

    <form action="amministratore.php" method="post">
        <div class="container">
            <h4>Effettua il login come AMMINISTRATORE:</h4><br>
            <label for="username"><strong>Username</strong></label>
            <input type="text" id="username" name="username" required>
            <hr>
            <br>

            <label for="nome"><strong>Nome</strong></label>
            <input type="text" id="nome" name="nome" required>
            <hr>
            <br>

            <label for="cognome"><strong>Cognome</strong></label>
            <input type="text" id="cognome" name="cognome" required>
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