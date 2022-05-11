<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'logo',
        'background',
        'description',
        'phone',
        'email',
        'subscription_price_without_ads',
        'subscription_price_with_ads',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function operators()
    {
        return $this->belongsToMany(User::class, 'channel_operator', 'channel_id', 'operator_id')
            ->withTimestamps();
    }

    public function subscribers()
    {
        return $this->hasMany(Subscription::class);
    }

    public function stations()
    {
        return $this->hasMany(Station::class);
    }
    
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function spotlights()
    {
        return $this->hasMany(Spotlight::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function lives()
    {
        return $this->hasMany(Live::class);
    }

    public function sports()
    {
        return $this->hasMany(Sport::class);
    }
}
