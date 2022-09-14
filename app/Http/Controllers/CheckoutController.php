<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function checkout_view(Request $request)
    {
        $total = 0;
        $data['categories'] = Category::all();
        if (Auth::check()) {
            $cart = Cart::with('product')->where(['user_id' => $request->user()->id])->get();
            $data['data'] = User::find($request->user()->id);
            $prospect = $data['data'];
            $prospect->user_id = $data['data']->id;
        } else {
            if (Cookie::has('guest_user_id')) {
                $guest_user_id = Cookie::get('guest_user_id');
                $cart = Cart::with('product')->where(['user_id' => $guest_user_id])->get();
                $data['data'] = [];
                $prospect = $data['data'];
                $prospect->user_id = $guest_user_id;
            } else {
                return redirect()->route('home');
            }
        }
        foreach ($cart as $item) {
            $total += $item->product->price * $item->qty;
        }
        if ($total == 0) {
            notify()->error('Cannot Proceed to Checkout page');
            return redirect()->route('home');
        }
        $ip = Http::get('https://api.ipify.org?format=json')['ip'];
        $ip_details = json_decode(Http::get('http://ip-api.com/json/' . $ip . '?fields=status,message,continent,country,countryCode,region,regionName,city,zip,lat,lon,timezone,currency,isp,org,as,mobile,proxy,hosting,query')->body());
        // return $ip_details   ;
        $old_prospect = Prospect::where('ip', $ip)->first();
        if ($old_prospect) {
            $old_prospect->products = $cart;
            $old_prospect->ip_details = $ip_details;
            $old_prospect->last_visited = Carbon::now();
            $old_prospect->save();
        } else {
            $prospect->ip = $ip;
            $prospect->ip_details = $ip_details;
            $prospect->products = $cart;
            $prospect->last_visited = Carbon::now();
            Prospect::create((array)$prospect->toArray());
        }
        $data['cart_items'] = $cart;
        $data['total'] = $total;
        return view('front.checkout-view', $data);
    }
}
