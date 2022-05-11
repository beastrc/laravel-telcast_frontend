<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Like;
use App\Models\Spotlight;
use App\Models\Visit;
use App\Models\Watch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with(['channels' => function ($q) use ($request) {
            if ($request->has('keywords')) {
                $q->where('title', 'LIKE', '%' . $request->keywords . '%');
            }
        }])->latest()->paginate(50);

        return view('frontend.channels.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        $spotlights = Spotlight::where('channel_id', $channel->id)->with('spotlightable')->limit(20)->get();

        switch (Auth::check()) {
            case true:
                $watches = Watch::where('user_id', Auth::id())
                    ->with(['watchable' => function ($query) use ($channel) {
                        $query->where('channel_id', $channel->id);
                    }])
                    ->groupBy(['watchable_id', 'watchable_type'])
                    ->latest('updated_at')
                    ->paginate(20);

                $paymentMethods = Auth::user()->userPaymentMethods;
                break;

            default:
                if (Session::has('guest')) {
                    $guest = Session::get('guest');

                    $watches = Watch::where('user_id', $guest['id'])
                        ->with(['watchable' => function ($query) use ($channel) {
                            $query->where('channel_id', $channel->id);
                        }])
                        ->latest()
                        ->paginate(20);
                }
                break;
        }

        $recommended = Like::whereHasMorph('likeable', '*', function ($query) use ($channel) {
                $query->where('channel_id', $channel->id);
            })->with(['likeable'])
            ->groupBy(['likeable_id', 'likeable_type'])
            ->orderByRaw('SUM(likes.liked) DESC')
            ->limit(20)->get();

        $trending = Visit::with('visitable')
            ->groupBy(['visitable_id', 'visitable_type'])
            ->orderByRaw('SUM(visits) DESC')
            ->limit(5)
            ->get();

        return view('frontend.channels.show', [
            'channel' => $channel,
            'payment_methods' => $paymentMethods ?? null,
            'spotlights' => $spotlights,
            'watches' => $watches ?? null,
            'recommended' => $recommended,
            'trending' => $trending ?? null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subscribe(Request $request, Channel $channel)
    {
        $request->validate([
            'payment_method' => ['required'],
            'type' => ['required'],
        ]);

        // Check if user hasn't already subscribed to this channel
        if (!userHasSubscribed($channel->id)) {
            $amount = $request->input('type') === 'without_ads' ? $channel->subscription_price_without_ads : $channel->subscription_price_with_ads;

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $product = Product::create(['name' => "{$channel->title} Subscription " . strtoupper(str_replace($request->type, '_', ' '))]);
            $price = Price::create([
                'product' => $product->id,
                'unit_amount' => $amount * 100, // in cents
                'currency' => 'usd',
                'recurring' => [
                    'interval' => 'month',
                ],
            ]);

            Auth::user()->newSubscription('default', $price->id)->add();

            Auth::user()->subscriptions()->create([
                'channel_id' => $channel->id,
                'price' => $amount,
                'expired_at' => Carbon::now()->addMonth(),
            ]);

            return redirect()->route('frontend.channels.show', $channel->id)->with(
                'success',
                'Successfully subscribed!'
            );
        }

        return redirect()->route('frontend.channels.show', $channel->id)->with(
            'error',
            'Already subscribed!'
        );
    }

    public function unsubscribe(Request $request, Channel $channel)
    {

    }
}
