<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'user_id',
		'visitable_id',
		'visitable_type',
		'ip_address',
		'user_agent',
		'visits'
	];

    public function visitable()
    {
        return $this->morphTo();
    }

//    public function likeable()
//    {
//        return $this->morphMany(Like::class, 'likeable');
//    }

	public function scopeOlderThanToday($query)
	{
		return $query->where('created_at', '<', Carbon::today());
	}
}
