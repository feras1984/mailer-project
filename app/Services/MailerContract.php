<?php

namespace App\Services;

interface MailerContract
{
    public function send($recipients = [], $cc = [], $bcc = [], $subject = '', $content = '', $attachments = [], $isHtml = true);
}
