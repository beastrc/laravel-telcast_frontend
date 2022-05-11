<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'logo',
        'country',
        'state',
        'county',
        'type',
        'status',
    ];

    public function operator()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
