<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCampaign extends Model
{
    use HasFactory;
    
    protected $table = 'ad_campaigns';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'title',
        'video_subject',
        'video_url',
        'country',
        'language',
        'age',
        'gender',
        'budget',
    ];

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'ad_campaign_channel', 'ad_campaign_id', 'channel_id')
            ->withTimestamps();
    }
}
