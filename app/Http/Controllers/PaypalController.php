<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Transaction;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
	/**
	 * Initiate Paypal Charge/Purchase Request
	 *
	 * @param       $period
	 * @param  Plan $plan
	 * @return string
	 */
	public function charge(Plan $plan, $period)
	{
		// Get plan amount
		$amount = $period === 'monthly' ? $plan->price : $plan->price_annual;
		
		// Initiate Paypal Client
		$provider = new PayPalClient;
		$provider->setApiCredentials(config('paypal'));
		$provider->setAccessToken($provider->getAccessToken());
		
		try {
			// Initiate charge request
			$response = $provider->createOrder([
				'intent' => 'CAPTURE',
				'purchase_units' => [[
					'reference_id' => Str::uuid(),
					'period' => 'monthly',
					'amount' => [
						'currency_code' => 'USD',
						'value' => $amount,
					],
				]],
				'application_context' => [
					'return_url' => route('user.payment.paypal.callback'),
					'cancel_url' => route('user.payment.paypal.cancel'),
				],
			]);
			
			if ($response['status'] === 'CREATED') {
				// Get transaction id from response
				$txn_id = $response['id'];
				
				// Create Transaction
				Transaction::create([
					'user_id' => Auth::id(),
					'plan_id' => $plan->id,
					'txn_id' => $txn_id,
					'amount' => $amount,
					'currency' => 'USD',
					'method' => 'paypal',
					'period' => $period,
				]);
				
				// Redirect to payment url
				return redirect()->to($response['links'][1]['href']);
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	/**
	 * Callback for Paypal payment after completion
	 *
	 * @param  Request $request
	 * @return RedirectResponse
	 */
	public function callback(Request $request)
	{
		// Check if callback request is coming from paypal
		$host = parse_url(request()->headers->get('referer'), PHP_URL_HOST);
		$sites = [
			'www.sandbox.paypal.com',
			'www.live.paypal.com',
			'www.api.sandbox.paypal.com',
			'www.api.paypal.com',
			'www.paypal.com',
		];
		
		if (in_array($host, $sites)) {
			// Initiate Paypal Client
			$provider = new PayPalClient;
			$provider->setApiCredentials(config('paypal'));
			$provider->setAccessToken($provider->getAccessToken());
			
			// Get payment status from paypal
			$response = $provider->capturePaymentOrder($request->token);
			
			if (isset($response, $response['status']) && $response['status'] === 'COMPLETED') {
				// On payment completion match record with current txn_id
				$transaction = Transaction::where('txn_id', $request->token)->firstOrFail();
				
				if ($transaction->exists()) {
					// Change transaction status from pending to completed
					$transaction->update([
						'status' => 1,
					]);
					
					// Get expiry for subscription
					$expired_at = $transaction->period === 'monthly' ? Carbon::now()->addMonth() : Carbon::now()->addYear();
					
					// Update user subscription
					Auth::user()->subscription()->update([
						'plan_id' => $transaction->plan->id,
						'period' => $transaction->period,
						'expired_at' => $expired_at,
						'status' => 1,
					]);
					
					// Redirect back to pricing page
					return redirect()->route('user.plans.index')->with('success', 'Payment successfully completed !');
				}
				
				return redirect()->route('user.plans.index')->with('error', 'Something went wrong while processing the payment !');
			}
			
			abort(400, 'INCOMPLETE PAYPAL PAYMENT');
		}
		
		abort(401);
	}
	
	/**
	 * Cancel request for Paypal payment
	 *
	 * @param  Request $request
	 * @return RedirectResponse
	 */
	public function cancel(Request $request)
	{
		// Check if cancel request is coming from paypal
		$host = parse_url(request()->headers->get('referer'), PHP_URL_HOST);
		$sites = [
			'www.sandbox.paypal.com',
			'www.live.paypal.com',
			'www.api.sandbox.paypal.com',
			'www.api.paypal.com',
			'www.paypal.com',
		];
		
		if (in_array($host, $sites)) {
			// On payment cancel match record with current txn_token
			$transaction = Transaction::where('txn_id', $request->token)->firstOrFail();
			
			if ($transaction->exists()) {
				// Change transaction status from pending to canceled
				$transaction->update([
					'status' => 2,
				]);
				
				// Redirect back to pricing page
				return redirect()->route('user.plans.index')->with('warning', 'Payment canceled !');
			}
			
			return redirect()->route('user.plans.index')->with('error', 'Something went wrong while processing the payment !');
		}
		
		abort(401);
	}
}