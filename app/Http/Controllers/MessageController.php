<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Jobs\SendMail;
use App\Mail\HelpDeskMail;
use App\Models\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Отображение формы отправки сообщений 
     * В куки записываю уникальный идентификатор для защиты от неограниченного кол-ва сообщений 
     */
    public function index()
    {
        $senderCookie = Cookie::has('sender_id') ? Cookie::get('sender_id') : cookie('sender_id', Str::random(10), 0);
        return (new Response(view('message')))->withCookie($senderCookie);
    }

    /**
     * Отправка сообщения по e-mail
     * и запись его в БД
     * @param \App\Http\Requests\MessageRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(MessageRequest $request, HelpDeskMail $helpDeskMail)
    {
        try {
            Message::create($request->all());

            //Синхронная отправка email
            // Mail::to(config('mail.helpdeskmail'))->send($helpDeskMail);

            //Добавляю в очередь отправку сообщения
            dispatch(new SendMail($helpDeskMail, config('mail.helpdeskmail')))->delay(10);

            return Redirect::back()->with(['success' => trans('message-form.success')]);
        } catch (\Exception $ex) {
            Log::error($ex);
            return Redirect::back()->withErrors(['message_content' => trans('message-form.send_error')]);
        }
    }
}
