<?php

namespace cms\core;

use cms\PHPMailer\src\PHPMailer;
use cms\PHPMailer\src\SMTP;
use cms\PHPMailer\src\Exception;

class Mailer
{

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
    }

    public function mailSend($from, $from_name, $pwd, $to, $subject, $body)
    {
        $mail = new PHPMailer();  // Creer un nouvel objet PHPMailer
        $mail->IsSMTP(); // active SMTP
        $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
        $mail->SMTPAuth = true;  // Authentification SMTP active
        $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = $from;
        $mail->Password = $pwd;
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->IsHTML(true);
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->send()) {
            return 'Mail error: '.$mail->ErrorInfo;
        } else {
            return true;
        }
    }

    public function sendVerifAuth($userEmail, $token, $userName)
    {
        $mail = new PHPMailer();  // Creer un nouvel objet PHPMailer
        // $mail->IsSMTP(); // active SMTP
        $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;  // Authentification SMTP active
        $mail->SMTPSecure = 'tls'; // Gmail REQUIERT Le transfert securise
        $mail->Username = 'nearby.cms@gmail.com';
        $mail->Password = 'Password123&';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SetFrom('admin@gmail.com', 'Nearby Administrateur');
        $mail->Subject = 'Activer votre compte !';
        $mail->Priority = 1;
        $mail->IsHTML(true);
        $body = '<!DOCTYPE html>
        <html lang="fr">

        <head>
        <meta charset="UTF-8">
        <title>Test mail</title>
        <style>
            .wrapper {
            padding: 20px;
            color: #444;
            font-size: 1.3em;
            }
            a {
            background: #592f80;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
            }
        </style>
        </head>

        <body>
        <div class="wrapper">
            <p>Merci de vous etre inscrit sur notre site Nearby. Cliquer sur le lien ci-dessous pour verifier votre compte ! :</p>
            <a href="http://localhost:8081/user-verif/'.$token.'">Verify Email!</a>
        </div>
        </body>

        </html>';

        $mail->Body = $body;
        $mail->AddAddress($userEmail, ucfirst($userName));
        
        if(!$mail->send()) {
            return 'Mailer error: ' . $mail->ErrorInfo;
        }
    }
}
