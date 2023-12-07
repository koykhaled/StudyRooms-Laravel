<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];


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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}