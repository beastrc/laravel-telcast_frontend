<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	use HasFactory;
	
	protected $fillable = [
        'channel_id',
		'name',
		'slug',
		'description',
		'thumbnail',
		'parent_id',
		'order',
	];
	
	public function children()
	{
		return $this->hasMany(Genre::class, 'parent_id')
		            ->with('children')
		            ->orderBy('order');
	}

    public function movies()
    {
        return $this->morphedByMany(Movie::class, 'genreable')
                    ->withTimestamps();
    }

    public function shows()
    {
        return $this->morphedByMany(Show::class, 'genreable')
            ->withTimestamps();
    }

    public function seasons()
    {
        return $this->morphedByMany(Season::class, 'genreable')
            ->withTimestamps();
    }

    public function episodes()
    {
        return $this->morphedByMany(Episode::class, 'genreable')
            ->withTimestamps();
    }

    public function lives()
    {
        return $this->morphedByMany(Live::class, 'genreable')
            ->withTimestamps();
    }

    public function sports()
    {
        return $this->morphedByMany(Sport::class, 'genreable')
            ->withTimestamps();
    }

    public function likedSports()
    {
        return $this->morphedByMany(Sport::class, 'likeable', 'likes');
    }

    public function genreables()
    {
//        return $this->movies()->union($this->movies());//->union($this->seasons)->union($this->episodes)->union($this->lives())->union($this->sports());
        return $this->hasMany(Genreable::class);
    }
}
