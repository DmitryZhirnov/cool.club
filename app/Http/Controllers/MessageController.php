<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function index()
    {
        $senderCookie = Cookie::has('sender_id') ? Cookie::get('sender_id') : cookie('sender_id', Str::random(10), 0);
        info($senderCookie);
        return (new Response(view('message')))->withCookie($senderCookie);
    }
}
