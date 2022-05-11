<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title'
    ];

    public function operators()
    {
        return $this->belongsToMany(User::class, 'network_operator', 'network_id', 'operator_id')
            ->withTimestamps();
    }
}
