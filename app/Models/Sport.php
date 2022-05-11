<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'title',
        'description',
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
        return $this->belongsToMany(Media::class, 'media_sport', 'sport_id', 'media_id')
            ->withPivot(['type'])
            ->withTimestamps();
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function myList()
    {
        return $this->morphOne(MyList::class, 'my_listable');
    }

    public function favorite()
    {
        return $this->morphOne(Favorite::class, 'favoriteable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
