<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mail;
use DB;
use Session;
use Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = User::where(['role' => 'admin'])->get();
        return view('admin.admins', $result);
    }
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!$validator->fails()) {
            $email = $request->post('email');
            $password = $request->post('password');
            $user = User::where(['email' => $email])->first();
            if ($user) {
                if ($user->role === 'admin') {
                    if (Hash::check($password, $user->password)) {
                        $request->session()->put('ADMIN_LOGIN', true);
                        $request->session()->put('ADMIN_ID', $user->id);
                        return redirect('admin/dashboard');
                    } else {
                        return redirect('admin')->with('Error! These credentials did not match our records');
                    }
                } else {
                    return redirect('admin')->with('login_error', 'Error! There credentials cannot be used for admin');
                }
            } else {
                return redirect('admin')->with('login_error', 'Error! These credentials did not match our records');
            }
        } else {
            return redirect('admin')->withErrors($validator)->withInput();
        }
    }
    public function dashboard()
    {
        $customers = User::where(['role' => 'customer'])->get();
        $today_orders = Order::where('created_at', '>=', Carbon::today())
            ->whereNotIn('order_status_id', [4, 5])
            ->get();
        $weekly_orders = Order::with('User')->where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->get();
        $total_income = Order::whereNotIn('order_status_id', [4, 5])->sum('total_amount');
        $data['customers_count'] = number_format($customers->count());
        $data['today_orders'] = number_format($today_orders->count());
        $data['today_total'] = number_format($today_orders->sum('total_amount'), 2);
        $data['weekly_orders'] = number_format($weekly_orders->count());
        $data['recent_orders'] = $weekly_orders;
        $data['weekly_total'] = number_format($weekly_orders->sum('total_amount'), 2);
        $data['total_income'] = number_format($total_income, 2);

        return view('admin.dashboard', $data);
        // return view('admin.dashboard');      
    }
    public function update_password()
    {
        $result = Admin::find(1);
        $result->password = Hash::make('ahsan');
        $result->save();
    }
    public function password_reset()
    {
        return view('admin.password_reset');
    }
    public function generate_link(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:3',
        ]);
        $email = $request->email;
        // return $email;
        $customer = Customer::where(['email' => $email])->first();
        if ($customer) {
            $customer->is_forgot_password = 1;
            $customer->rand_id = uniqid();
            $customer->save();

            $data = ['name' => $customer->name, 'rand_id' => $customer->rand_id];
            Mail::send('admin/forgot_email', $data, function ($messages) use ($email) {
                $messages->to($email);
                $messages->subject("Forgot Password");
            });
            return response()->json(['status' => true, 'message' => 'Password reset link has been send to your email.']);
        }
    }
    public function forgot_password_change(Request $request, $id)
    {

        $result = DB::table('customers')
            ->where(['rand_id' => $id])
            ->where(['is_forgot_password' => 1])
            ->get();

        if (isset($result[0])) {
            $request->session()->put('FORGOT_PASSWORD_USER_ID', $result[0]->id);
            return view('admin.forgot_password_change');
        } else {
            return redirect('/admin');
        }
    }
    public function forgot_password_change_process(Request $request)
    {
        if ($request->password1 == $request->password2) {
            DB::table('customers')
                ->where(['id' => $request->session()->get('FORGOT_PASSWORD_USER_ID')])
                ->update([
                    'is_forgot_password' => 0,
                    'password' => Hash::make($request->password1),
                    'rand_id' => ''
                ]);
            return response()->json(['status' => 'success', 'msg' => 'Password changed']);
        }
        return response()->json(['status' => false, 'msg' => 'Password change failed']);
    }
    public function create_admin(){
        return view('admin.create.admin');
    }
}
