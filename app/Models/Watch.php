<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'watchable_id',
        'watchable_type',
        'watch_time',
        'current_time',
        'ip_address',
        'user_agent',
    ];

    public function watchable()
    {
        return $this->morphTo();
    }
}
