<?php

namespace App\Services\SendGridService;

use App\Services\MailerContract;
use SendGrid\Mail\Mail;

class SendGridService implements MailerContract
{
    private Mail $mail;

    public function __construct()
    {
        $this->mail = new Mail();
    }

    public function send($recipients = [], $cc = [], $bcc = [], $subject = '', $content = '', $attachments = [], $isHtml = true)
    {
        // TODO: Implement send() method.
        $this->mail->setFrom(config('custom-mail.from-sendgrid'));
//        dd($this->mail);
        $this->mail->setSubject($subject);
        foreach ($recipients as $recipient) {
            $this->mail->addTo($recipient);
        }

        foreach ($cc as $item) {
            $this->mail->addCc($item);
        }

        foreach ($bcc as $item) {
            $this->mail->addBcc($item);
        }

        if ($isHtml) {
            $text = "text/plain";
        } else $text = "text/html";

        //Add Attachments:
        foreach ($attachments as $attachment) {
            $this->mail->addAttachment(
              $attachment['file'],
                "application/text",
                $attachment['name'],
                "attachment",
            );
        }

        $this->mail->addContent($text, $content);
//        dd($this->mail);
//        dd(config('custom-mail.sendgrid-key'));
//        dd($this->mail);

        $sendGrid = new \SendGrid(config('custom-mail.sendgrid-key'));
        //TODO: We have to change this option on real server!
        $sendGrid->client->setVerifySSLCerts(false);
        $response = $sendGrid->send($this->mail);
//        dd($response);

    }

}
