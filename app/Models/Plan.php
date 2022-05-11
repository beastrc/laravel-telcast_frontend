<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'title',
		'price',
		'price_discount',
		'price_annual',
		'price_annual_discount',
		'features',
		'status'
	];
	
	protected $casts = [
		'features' =>  'array'
	];
}
