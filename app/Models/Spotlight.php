<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spotlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'spotlightable_id',
        'spotlightable_type',
    ];

    public function spotlightable()
    {
        return $this->morphTo();
    }
}
