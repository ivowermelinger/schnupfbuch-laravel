<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInteraction extends Model
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
        'disliked',
    ];

    // Eloquent event for when a new interaction is created
    protected static function boot()
    {
        parent::boot();

        static::created(function ($interaction) {
            // Increment likes or dislikes based on 'liked' value
            if ($interaction->liked) {
                $interaction->line->increment('likes');
            } elseif ($interaction->disliked) {
                $interaction->line->increment('dislikes');
            }
        });

        static::updated(function ($interaction) {
            $original = $interaction->getOriginal();

            if ($original) {
                if ($original['liked'] && !$interaction->liked) {
                    $interaction->line->decrement('likes');
                } elseif (!$original['liked'] && $interaction->liked) {
                    $interaction->line->increment('likes');
                }

                if ($original['disliked'] && !$interaction->disliked) {
                    $interaction->line->decrement('dislikes');
                } elseif (!$original['disliked'] && $interaction->disliked) {
                    $interaction->line->increment('dislikes');
                }
            } else {
                if ($interaction->liked) {
                    $interaction->line->increment('likes');
                }

                if ($interaction->disliked) {
                    $interaction->line->increment('dislikes');
                }
            }
        });

        static::deleted(function ($interaction) {
            // Decrement likes or dislikes based on 'liked' value
            if ($interaction->liked) {
                $interaction->line->decrement('likes');
            } elseif ($interaction->disliked) {
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
