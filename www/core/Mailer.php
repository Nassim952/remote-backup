<?php

namespace cms\core\Mailer;
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

    public function sendVerifAuth($userEmail, $token)
    {
        $mail = new PHPMailer();  // Creer un nouvel objet PHPMailer
        $mail->IsSMTP(); // active SMTP
        $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
        $mail->SMTPAuth = true;  // Authentification SMTP active
        $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SetFrom('nearby.com');
        $mail->Subject = 'Activation du compte';
        $mail->IsHTML(true);
        $body = '<!DOCTYPE html>
        <html lang="en">

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
            <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
            <a href="http://localhost/cwa/verify-user/verify_email.php?token=' . $token . '">Verify Email!</a>
        </div>
        </body>

        </html>';
        $mail->Body = $body;
        $mail->AddAddress($userEmail);
        if(!$mail->send()) {
            return 'Mail error: '.$mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
