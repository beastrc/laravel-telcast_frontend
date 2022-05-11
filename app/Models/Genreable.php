<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genreable extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'genreable_id',
        'genreable_type',
    ];

    public function genres()
    {
        return $this->morphedByMany(Genre::class, 'genreable');
    }

    public function genreable()
    {
        return $this->morphTo();
    }
}
