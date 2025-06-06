<?php
ob_start();
$title = 'registrazione';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertTurista = 'INSERT INTO turisti (recapito, nome, cognome, nazionalita, email, lingua_madre, password) VALUES (:recapito, :nome, :cognome, :nazionalita, :email, :lingua_madre, :password)';
$querySelectLingue = 'SELECT * FROM lingue WHERE nome = :nome';
$queryInsertIntoLingue = 'INSERT INTO lingue (nome) VALUES (:nome)';

if (isset($_POST['recapito']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['nazionalita']) && isset($_POST['email']) && isset($_POST['lingua_madre']) && isset($_POST['password'])) {
    try {
        $stm = $db->prepare($querySelectLingue);
        $stm->bindValue(':nome', $_POST['lingua_madre']);
        $stm->execute();
        $data = $stm->fetch();
        $stm->closeCursor();

        if (!$data) {
            $stm = $db->prepare($queryInsertIntoLingue);
            $stm->bindValue(':nome', $_POST['lingua_madre']);
            $stm->execute();
            $stm->closeCursor();
        }

        $stm = $db->prepare($queryInsertTurista);
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':recapito', $_POST['recapito']);
        $stm->bindValue(':nome', $_POST['nome']);
        $stm->bindValue(':cognome', $_POST['cognome']);
        $stm->bindValue(':nazionalita', $_POST['nazionalita']);
        $stm->bindValue(':email', $_POST['email']);
        $stm->bindValue(':lingua_madre', $_POST['lingua_madre']);
        $stm->bindValue(':password', $hashed_password);
        $stm->execute();
        $stm->closeCursor();

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['nome'] = $_POST['nome'];
        setcookie('email', $_POST['email'], time() + 3600, '/');
        setcookie('nome', $_POST['nome'], time() + 3600, '/');

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alessandro.mizzon@iisviolamarchesini.edu.it';
            $mail->Password = '...';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('alessandro.mizzon@iisviolamarchesini.edu.it');
            $mail->addAddress('alessandro.mizzon@iisviolamarchesini.edu.it');
            $mail->Subject = 'Iscrizione avvenuta con successo';
            $mail->Body = 'Caro ' . $_POST['nome'] . ' ' . $_POST['cognome'] . ",\nti ringraziamo di aver effettuato l'iscrizione alla nostra piattaforma.\n\nIl team di Artifex.";
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->send();

            header('Location: ./home.php');
        } catch (Exception $e) {
            logError($e);
        }

        header('Location: ./account.php');
        exit;
    } catch (Exception $e) {
        logError($e);
        header('Location: ./registrazione.php');
    }
}

ob_end_flush();
?>

    <form action="registrazione.php" method="post">
        <div class="container">
            <h4><strong>Registrati</strong></h4>
            <hr style="margin-bottom: 3%">
            <label for="email"><strong>Email</strong></label>
            <input type="text" id="email" name="email" required>
            <hr>
            <br>

            <label for="recapito"><strong>Recapito</strong></label>
            <input type="text" id="recapito" name="recapito" required>
            <hr>
            <br>

            <label for="password"><strong>Password</strong></label>
            <input type="password" id="password" name="password" required>
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

            <label for="nazionalita"><strong>Nazionalità</strong></label>
            <input type="text" id="nazionalita" name="nazionalita" required>
            <hr>
            <br>

            <label for="lingua_madre"><strong>Lingua madre</strong></label>
            <input type="text" id="lingua_madre" name="lingua_madre" required>
            <hr>
            <br>

            <div class="submit-container">
                <input type="submit" value="Effettua registrazione">
            </div>
        </div>
    </form>

<?php require '../references/footer.php' ?>