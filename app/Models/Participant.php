<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    private static $praticipant_instance = null;

    public static function getParticipantInstance()
    {
        if (self::$praticipant_instance == null) {
            self::$praticipant_instance = new Participant();
        }
        return self::$praticipant_instance;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}