<?php

namespace App\Models;

use App\Traits\VisitorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory, VisitorTrait;

    protected $fillable = [
        'channel_id',
        'title',
        'description',
        'actors',
        'directors',
        'imdb_rating',
        'content_rating',
        'release_date',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'download',
        'subtitles',
        'upcoming',
        'premium',
        'status',
    ];

    protected $casts = [
        'actors' => 'array',
        'directors' => 'array'
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

    public function media()
    {
        return $this->belongsToMany(Media::class, 'media_movie', 'movie_id', 'media_id')
            ->withPivot(['type'])
            ->withTimestamps();
    }

    public function myList()
    {
        return $this->morphOne(MyList::class, 'my_listable');
    }

    public function favorite()
    {
        return $this->morphOne(Favorite::class, 'favoriteable');
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
