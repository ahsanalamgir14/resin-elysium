<?php

namespace App\Http\Controllers\Admin;

use Stripe;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Category;
use Carbon\Carbon, Mail;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use illuminate\support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    public function index()
    {
        $result['data'] = Order::all();
        $result['order_status'] = OrderStatus::get();
        return view('admin.orders', $result);
    }

    public function create()
    {
        // $result['categories'] = Category::all();
        // return view('admin.create.category', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'slug' => 'required',
        //     'image' => 'required',
        //     'is_home' => 'required',
        //     'status' => 'required',
        // ]);
        // $data = $request->all();
        // if ($request->hasFile('image')) {
        //     $random = uniqid();
        //     $image = $request->file('image');
        //     $ext = $image->extension();
        //     $image_name = $random . "." . $ext;
        //     $image->storeAs('public/categories', $image_name);
        //     $data['image'] = $image_name;
        // }
        // Category::create($data);
        // return redirect('admin/manage-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Order::with('order_status')->with('User')->find($id);
        // $data['products'] = OrderItem::with('Products')->where('order_id', $id)->get()->pluck('products');
        $data['order_items'] = OrderItem::with('Product')->where('order_id', $id)->get();
        // $data['total'] = $data['order_items']->sum('');
        // dd($data['products']);
        $data['categories'] = Category::where('id', '!=', $id)->get();
        return view('admin.show.order', $data);
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
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            // 'image' => 'required',
            'is_home' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $category = Category::where(['id' => $id])->first();
        if ($request->hasFile('image')) {
            unlink('storage/categories/' . $category->image);
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/categories', $image_name);
            $data['image'] = $image_name;
        }
        $category->update($data);
        return redirect('admin/manage-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back();
    }

    public function order_detail(Request $request, $id)
    {
        $result['orders_details'] =
            DB::table('order_details')
            ->select('orders.*', 'order_details.price', 'order_details.qty', 'products.product_name as pname', 'products.product_image', 'order_status.status as order_status')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('products_attr', 'products_attr.id', '=', 'order_details.products_attr_id')
            ->leftJoin('products', 'products.id', '=', 'products_attr.product_id')
            ->leftJoin('order_status', 'order_status.id', '=', 'orders.order_status_id')
            ->where(['orders.id' => $id])
            ->get();
        // dd($result['orders_details']);
        return view('admin.order_detail', $result);
    }
    public function delete_order(Request $request, $id)
    {

        $deleted = Order::where(['id' => $id])->delete();
        if ($deleted) {
            return response()->json(['status' => true, 'message' => 'Order removed successfully.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Error in deleting order']);
        }
    }
    public function customer_orders(Request $request)
    {
        $result['orders'] = Order::with('order_status')
            ->where(['user_id' => $request->session()->get('FRONT_USER_ID')])
            ->get();
        // dd($result['orders'][0]['order_status']['status']);
        return view('front.order', $result);
    }
    public function place_order(Request $request)
    {
        $request->validate([
            "first_name" => 'required',
            "last_name" => 'required',
            "email" => 'required|email',
            "mobile" => 'required',
            "address" => 'required',
            "city" => 'required',
            "state" => 'required',
            "country" => 'required',
            "zip_code" => 'required',
        ]);
        if (Auth::check()) {

            $user_id = $request->user()->id;
            $totalPrice = 0;
            $cart_items = get_user_cart_items($user_id);
            foreach ($cart_items as $list) {
                $totalPrice = $totalPrice + ($list->qty * $list->price);
            }
            $arr = [
                'id' => mt_rand(100000, 999999),
                "user_id" => $user_id,
                "order_status_id" => 1,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "payment_type" => $request->payment_type,
                "payment_status" => "Pending",
                "total_amount" => $totalPrice,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
            $order_id = Order::insertGetId($arr);
            if ($order_id > 0) {
                foreach ($cart_items as $list) {
                    $list->order_id = $order_id;
                    OrderItem::create((array)$list);
                }
                //delete-cart-items
                DB::table('carts')->where(['user_id' => $user_id, 'user_type' => 'user'])->delete();

                //online-payment
                if ($request->payment_type == 'card') {
                    $request->validate([
                        "amount" => 'required',
                        "source" => 'required',
                        "currency" => 'required',
                    ]);
                    $stripe['amount'] = $request->amount * 100;
                    $stripe['source'] = $request->source;
                    $stripe['currency'] = $request->currency;
                    $stripe['description'] = $request->description;
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $res = Stripe\Charge::create($stripe);
                    if ($res->status == 'succeeded') {
                        $res->order_id = $order_id;
                        Payment::create((array)$res);
                        // $payment['payment_id'] = $res->id;
                        // $payment['order_id'] = $res->order_id;
                        // $payment['type'] = $res->payment_method_details->card->brand;
                        // $payment['currency'] = $res->currency;
                        // $payment['account_no'] = $res->source->fingerprint;
                        // $payment['last_four'] = $res->source->last4;
                        // $payment['desc'] = $res->description;
                        // $payment['status'] = $res->status;
                    }
                }

                $data = ['data' => $arr, 'user_id' => $request->user()->id, 'items' => $cart_items, 'items_count' => count($cart_items)];
                $user['to'] = explode(',', env('ADMIN_EMAILS'));
                array_push($user['to'], $request->email);

                Mail::send('front/order_email', $data, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('Order Placed');
                });
                notify()->success('Order Placed Successfully.');
                return redirect('order/' . $order_id);
            } else {
                notify()->success('Please try after some time');
                return back();
            }
        } else {
            notify()->success('Please login to place order');
            return back();
        }
    }
    public function get_orders(Request $request)
    {
        $data['categories'] = Category::all();
        $data['orders'] = Order::with('order_status')
            ->where(['user_id' => $request->user()->id])
            ->get();
        // dd($data['orders']);
        return view('front.my_orders_view', $data);
    }
    public function order_information(Request $request)
    {
        $id = $request->id;
        $data = Order::with('order_status')->with('User')->find($id);
        $data['order_items'] = OrderItem::with('Product')->where('order_id', $id)->get();
        $data['categories'] = Category::where('id', '!=', $id)->get();
        return view('front.order-view', $data);
    }

    public function change_order_status(Request $request)
    {
        Order::where(['id' => $request->order_id])->update(['order_status_id' => $request->order_status]);
        notify()->success('Status Updated Successfully');
        return response()->json(['status' => true]);
    }
}
