<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use MenaraSolutions\Geographer\Earth;
use Illuminate\Validation\Rule;

use App\Models\Admin;
use App\Models\User;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mail;
use DB;

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

    public function create()
    {
        $earth = new Earth();
        $data['countries'] = $earth->getCountries()->useShortNames()->toArray();
        return view('admin.create.admin', $data);
    }

    public function show($id = NULL)
    {
        if ($id) {
            $earth = new Earth();
            $data['admin'] = User::where(['id' => $id])->first();
            $data['countries'] = $earth->getCountries()->useShortNames()->toArray();
        }
        return view('admin.show.admin', $data);
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
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required', 'max:255', Rule::unique('users')->ignore($id)],
            'address' => 'required|max:255',
            'mobile' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zip_code' => 'required|max:255',
        ]);

        $user = User::where(['id' => $id])->first();
        $data = $request->all();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->address = $data['address'];
        $user->mobile = $data['mobile'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->zip_code = $data['zip_code'];
        $user->status = 1; //to be added
        $user->save();
        notify()->success('Admin Updated Successfully');
        return back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        notify()->success('Admin Deleted Successfully');
        return redirect()->back();
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
        $customers_count = User::where(['role' => 'customer'])->count();
        $today_orders = Order::where('created_at', '>=', Carbon::today())
            ->whereNotIn('order_status_id', [5, 6, 7])->get();
        $weekly_orders = Order::with('User')->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->where('created_at', '<=', Carbon::now()->endOfWeek())
            ->get();
        $monthly_orders = Order::where('created_at', '>', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())
            ->whereNotIn('order_status_id', [5, 6, 7])->get();
        $data['customers_count'] = number_format($customers_count);
        $data['today_orders'] = number_format($today_orders->count());
        $data['today_revenue'] = number_format($today_orders->sum('total_amount'), 2);
        $data['weekly_orders'] = number_format($weekly_orders->count());
        $data['weekly_revenue'] = number_format($weekly_orders->sum('total_amount'), 2);
        $data['monthly_orders'] = number_format($monthly_orders->count());
        $data['monthly_revenue'] = number_format($monthly_orders->sum('total_amount'), 2);
        return view('admin.dashboard', $data);
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

    public function create_admin()
    {
        return view('admin.create.admin');
    }

    public function register_user(Request $request)
    {
        // return 1;
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'address' => 'required|max:255',
            'mobile' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zip_code' => 'required|max:255',
        ]);

        $data = $request->all();
        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->address = $data['address'];
        $user->mobile = $data['mobile'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->zip_code = $data['zip_code'];
        $user->status = 1; //implement this functionality
        $user->save();

        $result['data'] = User::where(['role' => 'customer'])->get();
        if ($request->role == 'admin') {
            notify()->success('Admin Created Successfully.');
            return view('admin.admins', $result);
        } else {
            notify()->success('Customer Created Successfully.');
            return view('admin.customers', $result);
        }
    }
}
