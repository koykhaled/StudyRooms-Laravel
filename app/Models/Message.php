<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    private static $message_instance = null;

    protected $fillable = [
        'message',
        'room_id'
    ];
    public static function getMessageInstance()
    {
        if (self::$message_instance == null) {
            self::$message_instance = new Message();
        }
        return self::$message_instance;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}