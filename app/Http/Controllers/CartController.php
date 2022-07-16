<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


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
    public function update(Request $request)
    {
        // dd($request->all());
        $product = Product::where(['id' => $request->product_id])->first();
        if ($product->qty < $request->qty) {
            notify()->error('Stock for ' . $request->qty . ' products not available');
            return response()->json(['status' => false]);
        }
        Cart::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->update(['qty' => $request->qty]);
        notify()->success('Cart Updated Successfully');
        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Cart::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->delete();
            return response()->json(['status' => true]);
        } catch (Throwable $e) {
            return response()->json(['status' => false]);
        }
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
            if (Cookie::has('guest_user_id')) {
                // if ($request->session()->has('guest_user_id')) {
                $guest_user_id = Cookie::get('guest_user_id');
                // $guest_user_id = $request->session()->get('guest_user_id');
            } else {
                Cookie::queue(Cookie::forever('guest_user_id', mt_rand(10000000, 99999999)));
                // $guest_user_id = $request->session()->put(['guest_user_id' => mt_rand(10000000, 99999999)]);
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
        if (Auth::check()) {
            $cart = Cart::with('product')->where(['user_id' => $request->user()->id])->get();
        } else {
            if (Cookie::has('guest_user_id')) {
                // if ($request->session()->has('guest_user_id')) {
                $guest_user_id = Cookie::get('guest_user_id');
                // $guest_user_id = $request->session()->get('guest_user_id');
                $cart = Cart::with('product')->where(['user_id' => $guest_user_id])->get();
            } else {
                return redirect()->route('home');
            }
        }
        foreach ($cart as $item) {
            $total += $item->product->price * $item->qty;
        }
        if ($total == 0) {
            notify()->error('Please Add some items. You cart is empty.');
            return redirect()->route('home');
        }
        $data['cart_items'] = $cart;
        $data['total'] = $total;
        $data['categories'] = Category::all();
        return view('front.cart-view', $data);
    }
}
