<?php

namespace App\Providers;

use App\Http\Requests\MessageRequest;
use App\Mail\HelpDeskMail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Регистрирую класс HelpDeskMail в сервис контейнере
        $this->app->bind(HelpDeskMail::class, function () {

            $request = $this->app->make(MessageRequest::class);
            return new HelpDeskMail($request->message_content);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
