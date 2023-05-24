<?php

namespace App\Providers;

use App\Services\MailerContract;
use App\Services\MailgunService\MailgunService;
use App\Services\PHPMailerService\PHPMailerService;
use App\Services\SendGridService\SendGridService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MailerContract::class, function () {
//            TODO: Switch Mail Services from here!
//            return new PHPMailerService();
            return new SendGridService();
//            return new MailgunService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
