<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель сообщений
 */
class Message extends Model
{
    protected $fillable = [
        'message_content',
        'sender_id'
    ];
}
