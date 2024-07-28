<?php

namespace App\Models;

use App\Enums\Roles;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasFactory;
	use Notifiable;
	use HasUuids;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'nickname',
		'email',
		'password',
		'role'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function lines()
	{
		return $this->hasMany(Line::class, 'user_id');
	}

	public function interactions()
	{
		return $this->hasMany(UserInteraction::class);
	}

	public function views()
	{
		return $this->hasMany(View::class);
	}

	/**
	 * Send a password reset notification to the user.
	 *
	 * @param  string  $token
	 */
	public function sendPasswordResetNotification($token): void
    {
        $resetUrl = url('/password/reset/' . $token . '?email=' . $this->email);
        $this->notify(new ResetPasswordNotification($resetUrl));
    }

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
			'role' => Roles::class,
		];
	}
}
