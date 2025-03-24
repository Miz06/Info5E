<?php
use PHPMailer\PHPMailer\PHPMailer; //inclusione libreria per usare la classe PHPmailer
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

//COMPOSER = gestore di package (in php package = libreria)
//utilizzo di PHPMailer per l'inio di mail tramite PHP

try{
    $mail->SMTPDebug=2; //mostra i dati ralativi all mail inviata
    $mail->isSMTP(); //protocollo mail
    $mail->Host='smtp.gmail.com'; //mail SMTP server
    $mail->SMTPAuth=true; //autorizzazione
    $mail->Username='alessandro.mizzon@iisviolamarchesini.edu.it';
    $mail->Password='...';
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS; //ENCRYPTION_STARTTLS = costante all'interno della classe PHPMailer
    $mail->Port=587;
    $mail->setFrom('alessandro.mizzon@iisviolamarchesini.edu.it');
    $mail->addAddress('alessandro.mizzon@iisviolamarchesini.edu.it');
    $mail->Subject='Test email using PHPMailer library';
    $mail->Body='Ciao';
    $mail->CharSet='UTF-8';
    $mail-> Encoding='base64';
    $mail->send();
    echo 'Message has been sent successfully';
}catch(Exception $e){
    echo "Error: {$mail->ErrorInfo}";
}