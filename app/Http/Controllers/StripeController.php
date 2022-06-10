<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('front.stripe-view');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        $payment = $request->except('_token');
        $payment['amount'] = $payment['amount'] * 100;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create($payment);
        notify()->success('Payment has been successfully processed.');
        return back();
    }
}
