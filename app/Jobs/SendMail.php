<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mail;
    private $to;

    /**
     * Create a new job instance.
     * Отправка сообщений по email
     * @param Mailable $mail - класс сообщения email реализующий интерфейс Mailable
     * @param string $to - получатель email
     * @return void
     */
    public function __construct(Mailable $mail, string $to)
    {
        $this->mail = $mail;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Mail::to($this->to)->send($this->mail);
        // Иммитация отправки сообщения. Записываю тело сообщения в laravel.log
        info($this->mail);
    }
}
