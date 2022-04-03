<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $result['data'] = Order::all();
        return view('admin.orders', $result);
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
}
