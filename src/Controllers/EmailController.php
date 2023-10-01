<?php

namespace Senac\Projeto\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailController implements Controller
{
    public function processaRequisicao(): void
    {
        $nome = filter_input(INPUT_POST, 'nome');
        if ($nome === false || $nome == null) {
            header('Location: /?sucesso=0');
            exit();
        }
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if ($email === false || $email == null) {
            header('Location: /?sucesso=0');
            exit();
        }
        $mensagem = filter_input(INPUT_POST, 'mensagem');
        if ($mensagem === false || $mensagem == null) {
            header('Location: /?sucesso=0');
            exit();
        }

        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dev.nicolasstorti@gmail.com';
            $mail->Password   = 'ltmdoktegpcifwqf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Pára onde as informações vão ser mandadas
            $mail->setFrom('dev.nicolasstorti@gmail.com', 'Mensagem Barber - Cliente');
            $mail->addAddress('dev.nicolasstorti@gmail.com', 'Nicolas');
            $mail->addReplyTo('dev.nicolasstorti@gmail.com', 'Information');
            $mail->isHTML(true);
            $mail->Subject = 'Mensagem via Site - BarberShop';

            /* Exibição da mensagem no email */
            $body = "Mensagem enviada através do site, segue informações abaixo:<br>
        Nome: ". $nome ."<br>
        E-mail: ". $email ."<br>
        Mensagem:<br>".
                $mensagem;

            $mail->Body    = $body;


            $mail->send();
            header('Location: /agradecimento?sucesso=1');
        } catch (Exception $e) {
            echo "Erro ao enviar o E-mail: {$mail->ErrorInfo}";
        }
    }
}