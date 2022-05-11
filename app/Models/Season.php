<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	use HasFactory;

	protected $fillable = [
        'channel_id',
        'show_id',
		'title',
		'description',
		'trailer',
		'meta_title',
		'meta_description',
		'meta_keywords',
		'status',
	];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function genres()
    {
        return $this->morphToMany(Genre::class, 'genreable')
            ->withTimestamps();
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable')
            ->withTimestamps();
    }

    public function show()
	{
		return $this->belongsTo(Show::class);
	}
	
	public function media()
	{
		return $this->belongsToMany(Media::class, 'media_season', 'season_id', 'media_id')
		            ->withPivot(['type'])
		            ->withTimestamps();
	}
	
	public function episodes()
	{
		return $this->hasMany(Episode::class);
	}
}
