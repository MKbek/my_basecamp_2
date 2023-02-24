<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicMessage extends Model
{
    use HasFactory;

    public $table = 'topic_messages';

    protected $fillable = [
        'topic_id',
        'user_id',
        'message',
    ];
}
