<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\Models\Cart;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // $request->session()->forget('guest_user_id');

        if ($request->checkout_login) {
            if (Cookie::has('guest_user_id')) {
                $guest_user_id = Cookie::get('guest_user_id');
                $user_items = Cart::where(['user_id' => Auth::id()])->get();
                // return $user_items;
                $guest_user_items = Cart::where(['user_id' => $guest_user_id])->get();
                if (count($user_items) > 0) {
                    foreach ($user_items as $u_item) {
                        foreach ($guest_user_items as $g_item) {
                            if ($u_item->product_id == $g_item->product_id) {
                                $u_item->qty = $g_item->qty;
                                $u_item->save();
                                $g_item->delete();
                            } else {
                                $g_item->user_id = $u_item->user_id;
                                $g_item->user_type = 'user';
                                $g_item->save();
                            }
                        }
                    }
                } else {
                    foreach ($guest_user_items as $g_item) {
                        // dd('die');
                        $g_item->user_id = Auth::id();
                        $g_item->save();
                    }
                }
            }
            return back();
        }
        // to admin dashboard
        if ($user->isAdmin()) {
            return redirect(route('admin_dashboard'));
        }

        // to user dashboard
        if ($user->isCustomer()) {
            return redirect('/');
        }

        abort(404);
    }
}
