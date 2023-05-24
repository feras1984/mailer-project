<?php
    return [
//        PHPMAILER Config:
        'from' => env('MAIL_FROM_ADDRESS'),
        'mailer' => env('MAIL_MAILER'),
        'port' => env('MAIL_PORT'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'encryption' => env('MAIL_ENCRYPTION'),
        'host' => env('MAIL_HOST'),
        'name' => env('MAIL_FROM_NAME'),
        'smtp-auth' => env('ENABLE_SMTP_AUTH'),
//        SENDGRID Config:
        'from-sendgrid' => env('SENDGRID_USERNAME'),
        'sendgrid-key' => env('SENDGRID_API_KEY'),
//        MAILGUN Config:
        'mailgun-username' => env('MAILGUN_USERNAME'),
        'mailgun-key' => env('MAILGUN_API_KEY'),
        'mailgun-domain' => env('MAILGUN_DOMAIN'),
    ];
