<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use function Illuminate\Events\queueable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'country',
        'state',
        'city',
        'gender',
        'date_of_birth',
        'avatar',
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(queueable(function ($user) {
            $user->syncStripeCustomerDetails();
        }));
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channel_operator', 'operator_id', 'channel_id')
            ->withTimestamps();
    }

    public function network()
    {
        return $this->hasOne(Network::class);
    }

    public function mySubscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function userPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function likedMovies()
    {
        return $this->morphedByMany(Movie::class, 'likeable', 'likes');
    }

    public function likedEpisodes()
    {
        return $this->morphedByMany(Episode::class, 'likeable', 'likes');
    }

    public function likedLives()
    {
        return $this->morphedByMany(Live::class, 'likeable', 'likes');
    }

    public function likedSports()
    {
        return $this->morphedByMany(Sport::class, 'likeable', 'likes');
    }

    public function visitedMovies()
    {
        return $this->morphedByMany(Movie::class, 'visitable', 'visits');
    }

    public function visitedEpisodes()
    {
        return $this->morphedByMany(Episode::class, 'visitable', 'visits');
    }

    public function visitedLives()
    {
        return $this->morphedByMany(Live::class, 'visitable', 'visits');
    }

    public function visitedSports()
    {
        return $this->morphedByMany(Sport::class, 'visitable', 'visits');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function adCampaigns()
    {
        return $this->hasMany(AdCampaign::class);
    }
}
