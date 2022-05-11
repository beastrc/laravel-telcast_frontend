<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'parent_id',
        'order',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('children')
            ->orderBy('order');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
