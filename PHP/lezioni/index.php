<?php
use PHPMailer\PHPMailer\PHPMailer; //inclusione libreria per usare la classe PHPmailer
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$email = new PHPMailer(true);

try{
    $email->isSMTP(); //protocollo email
    $email->Host='smtp.gmail.com'; //gmail SMTP server
    $email->SMTPAuth=true; //autorizzazione
}catch(Exception $e){
    echo "Error: $e";
};
