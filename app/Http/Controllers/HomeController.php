<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MenaraSolutions\Geographer\Earth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        if (!Auth::check()) {
            if (!Cookie::has('guest_user_id')) {
                Cookie::queue(Cookie::forever('guest_user_id', mt_rand(10000000, 99999999)));
            }
            // if (!$request->session()->has('guest_user_id')) {
            //     $request->session()->put(['guest_user_id' => mt_rand(10000000, 99999999)]);
            // }
        }
        $result['banners'] = HomeBanner::where(['status' => 1])->orderBy('id', 'desc')->get();
        $result['categories'] = Category::with(['products', 'sub_categories', 'parents'])->where(['status' => 1])->get();
        // dd($result['categories'][0]['parents']);
        $result['home_categories'] = Category::whereNotNull('parent_id')->with(['products', 'sub_categories.products'])->where(['is_home' => 1, 'status' => 1])->get();
        // $all_subcategories = $result['home_categories']->pluck('sub_categories')->collapse();
        // $all_subcategories = $result['home_categories']->pluck('sub_categories')->collapse()->pluck('products')->collapse();
        // foreach ($all_subcategories as $category) {
        //     $category['products'] = $all_subcategories->pluck('products')->collapse();
        // }
        // dd($all_products);

        // $result['home_categories'] = DB::table('categories as c1')->select('c1.*', 'c2.*')
        //     ->selectRaw('select c1 left join categories as c2 on c2.parent_id = c1.id as sub_categories')
        // ->leftJoin('categories as c2', 'c2.parentd_id', '=', 'c1.id')
        // ->join('products as p', function ($query) {
        // $query->whereRaw('p.category_id in (4)');
        // })

        // ->where(['c1.is_home' => 1, 'c1.status' => 1])->groupBy('c1.id')->get();
        // ->selectRaw('0 as products')
        $result['products'] = Product::with('category')->where(['status' => 1])->get();
        $result['trending_products'] = Product::where(['is_trending' => 1, 'status' => 1])->get();
        $result['best_seller_products'] = Product::where(['is_best_seller' => 1, 'status' => 1])->get();
        // dd($result['home_categories']);
        // var_dump($result['banners'][0]->image);
        return view('home', $result);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $result['categories'] = Category::with('sub_categories')->where(['status' => 1])->get();
        $query = Product::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('slug', 'LIKE', '%' . $request->search . '%')
            ->orWhere('type', 'LIKE', '%' . $request->search . '%')
            ->orWhere('desc', 'LIKE', '%' . $request->search . '%');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->sort) {
            $sort_by = $request->sort;
            if ($sort_by == 'name_asc') {
                $query->orderBy('name', 'asc');
            } else if ($sort_by == 'name_desc') {
                $query->orderBy('name', 'desc');
            } else if ($sort_by == 'price_asc') {
                $query->orderBy('price', 'asc');
            } else if ($sort_by == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }
        $result['products'] = $query->paginate(20);
        return view('front.search-view', $result);
    }

    public function profile(Request $request)
    {
        $earth = new Earth();
        $result['categories'] = Category::where(['status' => 1])->get();
        $result['customer'] = User::find($request->user()->id);
        $result['countries'] = $earth->getCountries()->useShortNames()->toArray();
        return view('front.profile', $result);
    }

    public function account(Request $request)
    {
        $earth = new Earth();
        $result['categories'] = Category::where(['status' => 1])->get();
        $result['customer'] = User::find($request->user()->id);
        return view('front.my-account', $result);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:12',
            'confirm_password' => 'required|same:password|min:6'
        ]);

        $data = $request->all();
        $user = User::find($data['id']);
        $user->password = Hash::make($data['password']);
        $user->save();
        notify()->success('Password changed Successfully');
        return back();
    }

    public function logout(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('home');
    }
}
