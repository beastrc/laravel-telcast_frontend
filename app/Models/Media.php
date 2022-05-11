<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	use HasFactory;
	
	protected $fillable = [
        'channel_id',
		'title',
		'type',
		'size',
		'extension',
		'duration',
		'path',
	];
	
	/**
	 * Scope a query to only include poster.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePoster($query, $relation)
	{
		return $query->where("media_{$relation}.type", 'poster');
	}

    /**
     * Scope a query to only include poster.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function scopeTrailer($query, $relation)
    {
        return $query->where("media_{$relation}.type", 'trailer');
    }

    /**
	 * Scope a query to only include poster.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function scopeVideos($query, $relation)
	{
		return $query->whereIn("media_{$relation}.type", ['1080p', '720p', '480p', '360p']);
	}
	
	/**
	 * Scope a query to only include poster.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function scopeSubtitles($query, $relation)
	{
		return $query->where("media_{$relation}.type", 'subtitle');
	}
	
	public function episodes()
	{
		return $this->belongsToMany(Episode::class, 'media_episode', 'media_id', 'episode_id')
		            ->withPivot(['type'])
		            ->withTimestamps();
	}
}
