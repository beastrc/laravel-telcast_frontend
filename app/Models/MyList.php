<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'my_listable_id',
        'my_listable_type',
    ];

    public function myListable()
    {
        return $this->morphTo();
    }
}
