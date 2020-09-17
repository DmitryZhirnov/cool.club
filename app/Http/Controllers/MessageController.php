<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
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
    public function send(MessageRequest $request)
    {
        try {
            Message::create($request->all());

            return Redirect::back()->with(['success' => 'Сообщение успешно отправлено!']);
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors(['message_content' => 'Ошибка отправки сообщения!']);
        }
    }
}
