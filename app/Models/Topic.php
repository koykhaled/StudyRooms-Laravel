<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    private static $instance = null;
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public static function getTopicInstance()
    {
        if (Topic::$instance === null) {
            self::$instance = new Topic();
            return self::$instance;
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name, '-');
        });
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}