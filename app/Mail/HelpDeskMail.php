<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelpDeskMail extends Mailable
{
    use Queueable, SerializesModels;

    private $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $messageContent)
    {
        $this->messageContent  = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.helpdesk', ['messageContent' => $this->messageContent]);
    }

    // Добавил для иммитации отправки сообщения
    // Тело сообщения запишется в laravel.log
    public function __toString()
    {
        return $this->messageContent;
    }
}
