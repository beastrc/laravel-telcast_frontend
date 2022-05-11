<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class VisitCounter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request->route()->parameters();

        $routes = ['frontend.trending.index', 'frontend.trending.show', 'frontend.shows.genres'];

        if (!in_array($request->route()->getName(), $routes)) {
            if (!empty($parameters)) {
                $model = end($parameters);

                switch (Auth::check()) {
                    case true:
                        $user_id = Auth::id();
                        break;

                    default:
                        $user_id = Str::uuid();
                        $visits = collect();

                        // If guest is already in session, update id and visits
                        if (Session::exists('guest')) {
                            $session = Session::get('guest');

                            $user_id = $session->get('id');
                            $visits = $session->get('visits');
                        }

                        if ($visits->isNotEmpty()) {
                            $exists = $visits
                                ->where('created_at', '>', Carbon::parse('-24hours'))
                                ->where('created_at', '<', Carbon::now())
                                ->where('visitable_id', $model->id)
                                ->where('visitable_type', get_class($model))
                                ->where('ip_address', $request->ip())
                                ->first();

                            if (!empty($exists)) {
                                $exists->visits += 1;
                            } else {
                                $visits->push((object)[
                                    'user_id' => $user_id,
                                    'visitable_id' => $model->id,
                                    'visitable_type' => get_class($model),
                                    'ip_address' => $request->ip(),
                                    'user_agent' => $request->userAgent(),
                                    'created_at' => Carbon::now(),
                                    'visits' => 1,
                                ]);
                            }
                        } else {
                            $visits->push((object)[
                                'user_id' => $user_id,
                                'visitable_id' => $model->id,
                                'visitable_type' => get_class($model),
                                'ip_address' => $request->ip(),
                                'user_agent' => $request->userAgent(),
                                'created_at' => Carbon::now(),
                                'visits' => 1,
                            ]);
                        }

                        // Create/Update guest session
                        Session::put('guest', collect([
                            'id' => $user_id,
                            'visits' => $visits,
                        ]));
                        break;
                }

                // Create visit record in database
                Visit::where('created_at', '>', Carbon::parse('-24hours'))
                    ->where('created_at', '<', Carbon::now())
                    ->updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'visitable_id' => $model->id,
                            'visitable_type' => get_class($model),
                            'ip_address' => $request->ip(),
                        ],
                        [
                            'visitable_id' => $model->id,
                            'visitable_type' => get_class($model),
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->userAgent(),
                        ])
                    ->increment('visits');
            }
        }

        return $next($request);
    }
}
