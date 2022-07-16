<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Category;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        } else {
            if (Cookie::has('guest_user_id')) {
                // if ($request->session()->has('guest_user_id')) {
                $guest_user_id = Cookie::get('guest_user_id');
                // $guest_user_id = $request->session()->get('guest_user_id');
                $cart = Cart::with('product')->where(['user_id' => $guest_user_id])->get();
                $data['data'] = [];
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
        $data['cart_items'] = $cart;
        $data['total'] = $total;
        return view('front.checkout-view', $data);
    }
}
