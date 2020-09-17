<?php

namespace App\Http\Middleware;

use App\Models\Message;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class CheckMessageSenderMiddleware
{
    /**
     * Handle an incoming request.
     * Ограничиваем повторную отправку сообщений через определенный интервал времени
     * Интервал записан в конфигурационном файле config/mail.php , ключ interval
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $senderId = Cookie::get('sender_id');
        $messageInterval = config('mail.interval');

        $message = Message::whereSenderId($senderId)->latest()->first();

        if ($message && $message->created_at > Carbon::now()->addMinutes(-$messageInterval)) {
            return Redirect::back()
                ->withErrors(['message_content' => "Повторно сообщение можно отправить только через {$messageInterval} мин."]);
        }

        // Добавляю к $request отправителя сообщения
        $request['sender_id'] = $senderId;

        return $next($request);
    }
}
