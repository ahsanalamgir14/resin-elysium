<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\HomeBanner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(!Auth::check()){
            if (!$request->session()->has('guest_user_id')) {
                $request->session()->put(['guest_user_id' => mt_rand(10000000, 99999999)]);
            }
        }
        $result['banners'] = HomeBanner::where(['status'=>1])->get();
        $result['categories'] = Category::with('sub_categories')->where(['status'=>1])->get();
        $result['products'] = Product::with('category')->where(['status'=>1])->get();
        // dd($result['products']);
        // var_dump($result['banners'][0]->image);
        return view('home', $result);
    }

    public function logout(Request $request)
    {
        Session::flush();
        
        Auth::logout();

        return redirect('home');
    }
}
