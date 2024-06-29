<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLineInteraction extends Model
{
    use HasFactory;

    protected $table = 'user_interactions';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'line_id',
        'liked',
    ];

    // Eloquent event for when a new interaction is created
    protected static function boot()
    {
        parent::boot();

        static::created(function ($interaction) {
            // Increment likes or dislikes based on 'liked' value
            if ($interaction->liked) {
                $interaction->line->increment('likes');
            } else {
                $interaction->line->increment('dislikes');
            }
        });

        static::deleted(function ($interaction) {
            // Decrement likes or dislikes based on 'liked' value
            if ($interaction->liked) {
                $interaction->line->decrement('likes');
            } else {
                $interaction->line->decrement('dislikes');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id');
    }
}
