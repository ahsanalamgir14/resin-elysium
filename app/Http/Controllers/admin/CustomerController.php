<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data'] = User::where(['role' => 'customer'])->get();
        return view('admin/customers', $result);
    }

    public function create()
    {
        return view('admin.create.customer');
    }

    public function show($id = NULL)
    {
        if ($id) {
            $arr = User::where(['id' => $id])->get();
            $result['customer_data'] = $arr[0];
        }
        return view('admin/show_customer', $result);
    }

    public function delete(Request $request, $id)
    {
        $model = User::find($id);
        $model->delete();
        notify()->success('Customer Deleted Successfully.');
        return redirect('admin/customer');
    }

    public function status(Request $request, $status, $id)
    {
        $model = User::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Customer Updated Successfully.');
        return redirect('admin/customer');
    }
}
