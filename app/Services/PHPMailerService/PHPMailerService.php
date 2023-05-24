<?php

namespace App\Services\PHPMailerService;

use App\Services\MailerContract;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class PHPMailerService implements MailerContract
{
    private $mail;
    public function __construct()
    {
//        dd(config('custom-mail.host'));
        $this->mail = new PHPMailer(true);
        $this->mail->setFrom('from@example.com', 'Mailer');
        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = config('custom-mail.host');                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = config('custom-mail.smtp-auth');                  //Enable SMTP authentication
        $this->mail->Username   = config('custom-mail.username');                     //SMTP username
        $this->mail->Password   = config('custom-mail.password');                               //SMTP password
        $this->mail->SMTPSecure = config('custom-mail.encryption');            //Enable implicit TLS encryption
        $this->mail->Port       = config('custom-mail.port');                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    public function send($recipients = [], $cc = [], $bcc = [], $subject = '', $content = '', $attachments = [], $isHtml = true) {

        //Recipients


        //Add Recipients:
        foreach ($recipients as $recipient) {
            $this->mail->addAddress($recipient);
        }

        //Add CC:
        foreach ($cc as $item) {
            $this->mail->addCC($item);
        }

        //Add BCC:
        foreach ($bcc as $item) {
            $this->mail->addBCC($item);
        }

        //Content
        $this->mail->isHTML($isHtml);                                  //Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $content;
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $this->mail->send();
    }
}
