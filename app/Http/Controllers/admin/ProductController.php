<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $result['data'] = Product::where(['status'=>1])->get();
        $result['data'] = Product::all();
        // dd($result['data']);
        return view('admin.products', $result);
    }

    public function create()
    {
        $result['categories'] = Category::all();
        return view('admin.create.product', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'main_image' => 'required',
            'main_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'slug' => 'required',
            'type' => 'required',
            'SKU' => 'required',
            'price' => 'required',
            'qty' => 'required',
            '3d_model' => 'required',
            'status' => 'required',
            'desc' => 'required',
        ]);
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('main_image')) {
            $random = uniqid();
            $image = $request->file('main_image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/products', $image_name);
            $data['main_image'] = $image_name;
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $random = uniqid();
                // $image = $request->file('images');
                $ext = $image->extension();
                $image_name = $random . "." . $ext;
                $image->storeAs('public/product_images', $image_name);
                $images[] = $image_name;
            }
        }
        $data['images'] = $images;
        Product::create($data);
        return redirect('admin/manage-products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('die');
        $data = Product::find($id);
        $data['categories'] = Category::where('id', '!=', $id)->get();
        return view('admin.show.product', $data);
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
            // 'main_image' => 'required',
            // 'main_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'slug' => 'required',
            'type' => 'required',
            'SKU' => 'required',
            'price' => 'required',
            'qty' => 'required',
            // '3d_model' => 'required',
            'status' => 'required',
            'desc' => 'required',
        ]);
        $data = $request->all();
        $product = Product::where(['id' => $id])->first();
        // dd($data);
        if ($request->hasFile('main_image')) {
            unlink('storage/products/' . $product->main_image);
            $random = uniqid();
            $image = $request->file('main_image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/products', $image_name);
            $data['main_image'] = $image_name;
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $random = uniqid();
                // $image = $request->file('images');
                $ext = $image->extension();
                $image_name = $random . "." . $ext;
                $image->storeAs('public/product_images', $image_name);
                $images[] = $image_name;
            }
            foreach ($product->images as $prev_image) {
                unlink('storage/product_images/' . $prev_image);
            }
            $data['images'] = $images;
        }
        $product->update($data);
        return redirect('admin/manage-products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        // $product->images = json_decode($product->images);
        $product->images = $product->images;
        if (Storage::disk('public')->exists('products/' . $product->main_image)) {
            unlink('storage/products/' . $product->main_image);
        }
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists('product_images/' . $image)) {
                unlink('storage/product_images/' . $image);
            }
        }
        $product->delete();
        notify()->success('Product Deleted Successfully');
        return redirect()->back();
    }

    public function product_view(Request $request)
    {
        $result['categories'] = Category::all();
        $result['product'] = Product::with('category')->where('slug', $request->slug)->first();
        $result['related_products'] = Product::with('category')->where('category_id', $result['product']->category_id)
            ->where('slug', '!=', $request->slug)->get();
        // dd($result['related_products']);
        return view('front.product-view', $result);
    }

    public function show_all_products(Request $request)
    {
        // dd($request->all());
        $result['categories'] = Category::with(['products'])->get();
        $query = Product::select('products.*', DB::raw('GROUP_CONCAT(c.id) as child_categories'))->distinct();
        if ($request->category) {
            $query->where('products.category_id', $request->category);
        }
        if ($request->filter_categories) {
            $query->WhereIn('products.category_id', $request->filter_categories)
                ->leftJoin('categories as c', function ($sub_join) use ($request) {
                    $sub_join->whereIn('c.parent_id', $request->filter_categories);
                });
            $children_categories = $query->pluck('child_categories')->toArray();
            $children_categories = array_map('intval', explode(',', $children_categories[0]));
            $query->orWhereIn('products.category_id', $children_categories);
        }
        if ($request->product_type) {
            $query->Where($request->product_type, 1);
        }
        if ($request->sort) {
            $sort_by = $request->sort;
            if ($sort_by == 'name_asc') {
                $query->orderBy('products.name', 'asc');
            } else if ($sort_by == 'name_desc') {
                $query->orderBy('products.name', 'desc');
            } else if ($sort_by == 'price_asc') {
                $query->orderBy('products.price', 'asc');
            } else if ($sort_by == 'price_desc') {
                $query->orderBy('products.price', 'desc');
            }
        }
        $query = $query->groupBy('products.id')->paginate(20);
        $result['products'] = $query;
        // dd($result['products']);
        // dd($request->sort);
        $result['filter_categories'] = $request->filter_categories;
        $result['sort_by'] = $request->sort;
        return view('front.products-view', $result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Status Updated Successfully.');
        return redirect('admin/product');
    }

    public function apply_filters(Request $request)
    {
        $filters = $request->all();

        return $filters;
        $result['categories'] = Category::with('sub_categories')->get();
    }
}
