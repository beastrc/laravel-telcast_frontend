<?php

/**
 * Format bytes to kb, mb, gb, tb
 *
 * @param integer $size
 * @param integer $precision
 * @return integer
 */

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (!function_exists('formatFromBytes')) {
    function formatFromBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}

/**
 * Get poster for item
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getPoster')) {
    function getPoster($model)
    {
        return asset('storage/' . $model->media()->wherePivot('type', 'poster')->path
        // return asset('storage/' . $model->media()->wherePivot('type', 'poster')->first()->path
        // return asset('storage/app/private/media/How to load tokens in MetaMask Wallet_5f60d3f898b9fe80a6a491e7406bc558.mp4'
    );
    }
}

/**
 * Get trailer
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getTrailer')) {
    function getTrailer($model)
    {
        return $model->media()->wherePivot('type', 'trailer')->first();
    }
}

/**
 * Get trailer path
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getTrailerPath')) {
    function getTrailerPath($model)
    {
        dd($model);
        // return asset('private/media/' . getTrailer($model)->id);
    }
}

/**
 * Get trailer type
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getTrailerType')) {
    function getTrailerType($model)
    {
        return getTrailer($model)->type;
    }
}

/**
 * Get poster for item
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getVideos')) {
    function getVideos($model)
    {
        return $model->media()->wherePivotIn('type', ['1080p', '720p', '480p', '360p'])->get();
    }
}

/**
 * Get route for item
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getRoute')) {
    function getRoute($model)
    {
        $table = $model->getTable();

        switch ($table) {
            case 'movies':
                return route('frontend.movies.show', $model->id);

            case 'shows':
                return route('frontend.shows.show', $model->id);

            case 'seasons':
                return route('frontend.shows.seasons.show', [$model->show->id, $model->id]);

            case 'episodes':
                return route('frontend.shows.seasons.episodes.show', [$model->show->id, $model->season->id, $model->id]);

            case 'lives':
                return route('frontend.live.show', $model->id);

            case 'sports':
                return route('frontend.sports.show', $model->id);
        }
    }
}

/**
 * Get duration for item
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('getDuration')) {
    function getDuration($model)
    {
        $table = $model->getTable();

        if ($table === 'lives') return false;

        // $duration = $model->media()->whereNotNull('duration')->first()->duration;
        // $duration = $model->media()->duration;
        return CarbonInterval::seconds(105)->cascade()->format('%hh %im %ss');
    }
}

/**
 * Check if current item exists in favorites
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('isFavorite')) {
    function isFavorite($model)
    {
        return !empty($model->favorite()->where('user_id', Auth::id())->first());
    }
}

/**
 * Check if current item exists in my list
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('isListed')) {
    function isListed($model)
    {
        return !empty($model->myList()->where('user_id', Auth::id())->first());
    }
}

/**
 * Check current user plans to see if it is premium
 *
 * @param Model $model
 * @return integer
 */
if (!function_exists('isPremium')) {
    function isPremium($model)
    {
        return isset($model->premium) && $model->premium === 1;
    }
}

/**
 * Check if the network admin has its network (already created)
 *
 * @return boolean
 */
if (!function_exists('hasNetwork')) {
    function hasNetwork()
    {
        return Auth::user()->network()->exists();
    }
}

/**
 * Get network of current user
 *
 * @return boolean
 */
if (!function_exists('getNetwork')) {
    function getNetwork()
    {
        return Auth::user()->network;
    }
}

/**
 * Get channel of current operator
 *
 * @return boolean
 */
if (!function_exists('getChannel')) {
    function getChannel()
    {
        return Auth::user()->channels()->first();
    }
}

/**
 * Match current route with the provided one's
 *
 * @return boolean
 */
if (!function_exists('isCurrentRoute')) {
    function isCurrentRoute($route)
    {
        return in_array(Route::currentRouteName(), [$route]);
    }
}

/**
 * Get dashboard route based on user role
 *
 * @return boolean
 */
if (!function_exists('getDashboardRoute')) {
    function getDashboardRoute()
    {
        switch (auth()->user()->role) {
            case 'user':
                return route('user.dashboard.index');

            case 'admin':
                return route('admin.dashboard.index');

            case 'channel_operator':
                return route('channel.dashboard.index');
        }
    }
}

/**
 * Check if user is subscribed to current channel
 *
 * @return boolean
 */
if (!function_exists('userHasSubscribed')) {
    function userHasSubscribed($channel_id)
    {
        if (Auth::check()) {
            return Auth::user()->subscriptions()->where('channel_id', $channel_id)->exists();
        }
    }
}

/**
 * Check if user is subscribed to current channel using provided Model
 *
 * @return boolean
 */
if (!function_exists('isSubscribed')) {
    function isSubscribed($model)
    {
        if (Auth::check()) {
            $subscription = Auth::user()->mySubscriptions()->where('channel_id', $model->channel->id)->first();

            return !is_null($subscription) && $subscription->expired_at->lt(\Carbon\Carbon::now());
        }
    }
}

/**
 * Get current model name from model instance
 *
 * @return boolean
 */
if (!function_exists('getModelName')) {
    function getModelName($model)
    {
        if ($model instanceof \App\Models\Movie) {
            return 'movie';
        } else if ($model instanceof \App\Models\Show) {
            return 'show';
        } else if ($model instanceof \App\Models\Season) {
            return 'season';
        } else if ($model instanceof \App\Models\Episode) {
            return 'episode';
        } else if ($model instanceof \App\Models\Live) {
            return 'live';
        } else if ($model instanceof \App\Models\Sport) {
            return 'sport';
        }
    }
}

/**
 * Check if user avatar exists
 *
 * @return boolean
 */
if (!function_exists('hasAvatar')) {
    function hasAvatar()
    {
        return auth()->check() && !empty(auth()->user()->avatar);
    }
}

/**
 * Get current model name from model instance
 *
 * @return boolean
 */
if (!function_exists('getUserAvatar')) {
    function getUserAvatar()
    {
        if (auth()->check()) {
            return asset('storage/' . Auth::user()->avatar);
        }
    }
}

/**
 * Generate Random color
 *
 * @return boolean
 */
if (!function_exists('generateRandomColor')) {
    function generateRandomColor()
    {
        return '#' . substr(str_shuffle('AABBCCDDEEFF00112233445566778899AABBCCDDEEFF00112233445566778899AABBCCDDEEFF00112233445566778899'), 0, 6);
    }
}

