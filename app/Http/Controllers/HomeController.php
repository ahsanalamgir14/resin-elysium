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
        if (!Auth::check()) {
            if (!$request->session()->has('guest_user_id')) {
                $request->session()->put(['guest_user_id' => mt_rand(10000000, 99999999)]);
            }
        }
        $result['banners'] = HomeBanner::where(['status' => 1])->get();
        $result['categories'] = Category::with('sub_categories')->where(['status' => 1])->get();
        $result['products'] = Product::with('category')->where(['status' => 1])->get();
        // dd($result['products']);
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

    public function logout(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('home');
    }
}
