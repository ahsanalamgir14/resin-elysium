<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;

class CartController extends Controller
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

    public function add_to_cart(Request $request)
    {
        // dd($request->all());
        $model = new Cart();
        if (Auth::check()) {
            $user_id = $request->user()->id;
            $user_type = 'user';

            $cart = Cart::where(['user_id' => $request->user()->id, 'product_id' => $request->product_id])->first();
            if ($cart) {
                // dd('cart update for user');
                $request['user_id'] = $user_id;
                $request['user_type'] = $user_type;
                $cart->update($request->all());
                notify()->success('Product Updated in cart successfully');
                return response()->json([
                    'status' => true,
                    'title' => 'Product Updated!',
                    'message' => 'Product updated in cart successfully'
                ], 200);
            }
        } else {
            if ($request->session()->has('guest_user_id')) {
                $guest_user_id = $request->session()->get('guest_user_id');
            } else {
                $guest_user_id = $request->session()->put(['guest_user_id' => mt_rand(10000000, 99999999)]);
            }
            $cart = Cart::where(['user_id' => $guest_user_id, 'product_id' => $request->product_id])->first();
            if ($cart) {
                // dd('cart update for guest');
                $request['user_id'] = $guest_user_id;
                $request['user_type'] = 'guest';
                $cart->update($request->all());
                notify()->success('Product Updated in cart successfully');
                return response()->json([
                    'status' => true,
                    'title' => 'Product Updated!',
                    'message' => 'Product updated in cart successfully'
                ], 200);
            }
            $user_id = $guest_user_id;
            $user_type = 'guest';
        }

        $request['user_id'] = $user_id;
        $request['user_type'] = $user_type;
        Cart::create($request->all());
        notify()->success('Product added to cart successfully');
        return response()->json([
            'status' => true,
            'title' => 'Product Added!',
            'message' => 'Product added to cart successfully'
        ], 200);
    }

    public function cart_view(Request $request)
    {
        $total = 0;
        $data['categories'] = Category::all();
        if (Auth::check()) {
            $cart = Cart::with('product')->where(['user_id' => $request->user()->id])->get();
        } else {
            if ($request->session()->has('guest_user_id')) {
                $guest_user_id = $request->session()->get('guest_user_id');
            }
            $cart = Cart::with('product')->where(['user_id' => $guest_user_id])->get();
        }
        foreach ($cart as $item) {
            $total += $item->product->price * $item->qty;
        }
        $data['cart_items'] = $cart;
        // dd($data['cart_items']);
        $data['total'] = $total;
        return view('front.cart-view', $data);
    }
}
