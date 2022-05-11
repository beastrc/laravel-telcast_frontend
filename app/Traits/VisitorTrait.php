<?php

namespace App\Traits;

use App\Models\User;

trait VisitorTrait
{
	public function visitors()
	{
		return $this->morphToMany(User::class, 'visitable')
		            ->withTimestamps();
	}
}