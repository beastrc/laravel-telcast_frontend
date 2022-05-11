<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languageable extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'languageable_id',
        'languageable_type',
    ];

    public function languages()
    {
        return $this->morphedByMany(Language::class, 'languageable');
    }

    public function languageable()
    {
        return $this->morphTo();
    }
}