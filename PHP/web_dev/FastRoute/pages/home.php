<?php
ob_start();
$title = 'home';
require '../references/navbar.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$successMessage = 'Email inviata con successo!';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['content'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP(); // Protocollo mail
        $mail->Host = 'smtp.gmail.com'; // Mail SMTP server
        $mail->SMTPAuth = true; // Autorizzazione
        $mail->Username = 'alessandro.mizzon@iisviolamarchesini.edu.it';
        $mail->Password = '...';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sicurezza
        $mail->Port = 587;
        $mail->setFrom('alessandro.mizzon@iisviolamarchesini.edu.it');
        $mail->addAddress('alessandro.mizzon@iisviolamarchesini.edu.it');
        $mail->Subject = 'Question from ' . $nome . ' (' . $email . ')';
        $mail->Body = $content;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->send();

        header('Location: ./home.php');
    } catch (Exception $e) {
        logError($e);
    }
    ob_end_flush();
}
?>
    <div class="element">
        <h4>Informazioni relative alla gestione del plico</h4>
        <hr>
        <h6>1) Il cliente consegna il pacco in sede [data e ora registrate]</h6>
        <h6>2) Un membro del personale registra e immagazzina il plico </h6>
        <h6>3) Il plico viene spedito da un membro del personale in un'altra sede [data e ora registrate]</h6>
        <h6>4) Il plico è recapitato da un membro del personale </h6>
        <h6>5) Il destinatario ritira il plico [data e ora registrate]</h6>
    </div>

    <div class="element">
        <form method="post" action="home.php">
            <h4>Contattaci</h4>
            <hr>

            <br>
            <label for="nome"><strong>Il tuo nome</strong></label>
            <input type="text" name="nome" id="nome" required>

            <br><br>
            <label for="email"><strong>La tua email</strong></label>
            <input type="text" name="email" id="email" required>

            <br><br>
            <label for="content"><strong>Contenuto della email</strong></label>
            <input type="text" name="content" id="content" required>

            <div class="submit-container">
                <input type="submit" value="Invia email al team Fast Route">
            </div>
        </form>
    </div>

<?php require '../references/footer.php'; ?>