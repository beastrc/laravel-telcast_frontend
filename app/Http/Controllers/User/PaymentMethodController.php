<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instance = Auth::user()->userPaymentMethods()->latest();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->editColumn('pm_last_four', function ($row) {
                    $brand = '';
                    switch ($row->pm_brand) {
                        case 'visa':
                            $brand = '<i class="fab fa-cc-visa fa-lg mr-1"></i>';
                            break;

                        case 'mastercard':
                            $brand = '<i class="fab fa-cc-mastercard fa-lg mr-1"></i>';
                            break;

                        case 'amex':
                            $brand = '<i class="fab fa-cc-amex fa-lg mr-1"></i>';
                            break;

                        case 'discover':
                            $brand = '<i class="fab fa-cc-discover fa-lg mr-1"></i>';
                            break;

                        case 'diners':
                            $brand = '<i class="fab fa-cc-diners-club fa-lg mr-1"></i>';
                            break;

                        case 'jcb':
                            $brand = '<i class="fab fa-cc-jcb fa-lg mr-1"></i>';
                            break;

                        default:
                            $brand = '<i class="fab fa-cc-stripe fa-lg mr-1"></i>';
                            break;
                    }

                    return $brand . ' ' . $row->pm_last_four;
                })
                ->editColumn('pm_default', function ($row) {
                    if ($row->pm_default === 1) {
                        return '<span class="badge badge-warning">DEFAULT</span>';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url="' . route('user.payment-methods.default', $row->id) . '" class="btn-toggle dropdown-item">Set as Default</a>
									    </div>
									</div>';
                })
                ->rawColumns(['pm_last_four', 'pm_default', 'created_at', 'actions'])
                ->make(true);
        }

        return view('user.payment-methods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $intent = Auth::user()->createSetupIntent();

        return view('user.payment-methods.create', [
            'intent' => $intent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'pm_id' => ['required'],
            'pm_holder' => ['required']
        ]);

        // Attach card to customer & get card info
        Auth::user()->addPaymentMethod($request->pm_id);
        $payment_method = Auth::user()->findPaymentMethod($request->pm_id);

        Auth::user()->userPaymentMethods()->create([
            'pm_id' => $request->pm_id,
            'pm_holder' => $request->pm_holder,
            'pm_brand' => $payment_method->card->brand,
            'pm_last_four' => $payment_method->card->last4,
            'pm_default' => !Auth::user()->userPaymentMethods()->exists() ? 1 : 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Set the specified resource as default
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function default(PaymentMethod $paymentMethod)
    {
        Auth::user()->userPaymentMethods()->update([
            'pm_default' => 0
        ]);

        $paymentMethod->update([
            'pm_default' => 1
        ]);

        Auth::user()->updateStripeCustomer([
            'invoice_settings' => ['default_payment_method' => $paymentMethod->pm_id],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!'
        ]);
    }
}
