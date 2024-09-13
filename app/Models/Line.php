<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Line extends Model
{
	use HasFactory;
	use HasUuids;
	use SoftDeletes;
	use Searchable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'line',
		'likes',
		'dislikes',
		'user_id',
		'active',
	];

	protected $with = ['user'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function interactions()
	{
		return $this->hasMany(UserInteraction::class, 'line_id');
	}

	public function views()
	{
		return $this->hasMany(View::class);
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array<string, mixed>
	 */
	// #[SearchUsingFullText(['line'])]
	public function toSearchableArray(): array
	{
		$user = $this->user;

		return [
			'line' => $this->line,
		];
	}
}
