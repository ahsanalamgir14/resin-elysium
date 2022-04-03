<?php


namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin/coupon', $result);
    }
    public function manage_coupon($id=NULL)
    {
        if($id){
            $arr = Coupon::where(['id'=>$id])->get();
            $result['id'] = $arr[0]->id;
            $result['title'] = $arr[0]->title;
            $result['code'] = $arr[0]->code;
            $result['value'] = $arr[0]->value;
        }
        else{
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_coupon', $result);
    }
    public function manage_coupon_process(Request $request)
    {
        $id=$request->post('id');
        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons','code,'.$request->post('id'), 
            'value'=>'required'
        ]);
        
        if($id){
            $model = Coupon::find($id);
            $message='Coupon Updated Successfully';
        }else{
            $model = new Coupon();
            $message='Coupon Inserted Successfully';
        }
        $model->title=$request->post('title'); 
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->save();
        $request->session()->flash('success', $message);
        return redirect('admin/coupon');
    }
    public function delete(Request $request, $id)
    {
        $model= Coupon::find($id);
        $model->delete();
        $request->session()->flash('success', 'Coupon Deleted');
        return redirect('admin/coupon');        
    }
    public function status(Request $request, $status, $id)
    {
        $model= Coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('success', 'Status Updated');
        return redirect('admin/coupon');         
    }
}
