<?php

namespace App\Services\MailgunService;

use App\Services\MailerContract;
use Mailgun\Mailgun;

class MailgunService implements MailerContract
{
    private $mail;
    public function __construct()
    {
        $this->mail = Mailgun::create(config('custom-mail.mailgun-key'));
    }

    public function send($recipients = [], $cc = [], $bcc = [], $subject = '', $content = '', $attachments = [], $isHtml = true)
    {
        // TODO: Implement send() method.
        $response = $this->mail->messages()->send(config('custom-mail.mailgun-domain'), array(
            'from' => config('custom-mail.mailgun-username'),
            'to' => $recipients,
            'cc' => $cc,
            'bcc' => $bcc,
            'subject' => $subject,
            'text' => $content,
        ));
//        dd($response);
    }
}
