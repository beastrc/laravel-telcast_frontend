<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pm_id',
        'pm_holder',
        'pm_brand',
        'pm_last_four',
        'pm_default',
    ];
}
