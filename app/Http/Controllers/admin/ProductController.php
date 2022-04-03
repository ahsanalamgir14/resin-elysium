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
        $product->images = json_decode($product->images);
        if (Storage::disk('public')->exists('products/' . $product->main_image)) {
            unlink('storage/products/' . $product->main_image);
        }
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists('product_images/' . $image)) {
                unlink('storage/product_images/' . $image);
            }
        }
        $product->delete();
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

    public function manage_product($id = NULL)
    {
        if ($id) {
            $arr = Product::where(['id' => $id])->get();
            $result['id'] = $arr[0]->id;
            $result['category_id'] = $arr[0]->category_id;
            $result['product_name'] = $arr[0]->product_name;
            $result['product_slug'] = $arr[0]->product_slug;
            $result['product_type'] = $arr[0]->product_type;
            $result['product_price'] = $arr[0]->product_price;
            $result['product_image'] = $arr[0]->product_image;
            $result['product_desc'] = $arr[0]->product_desc;
            $result['product_3d'] = $arr[0]->product_3d;
            $product_attr = DB::table('products_attr')->where(['product_id' => $id])->get();
            // var_dump($product_attr);die;
            // if(empty($product_attr[0])){
            // $arr[]='1';
            // $result['product_attr'] = $arr;
            // var_dump($result);die;
            // }else{
            $result['product_attr'] = $product_attr;
            // var_dump($result);die;
            // }
        } else {
            $result['id'] = 0;
            $result['category_id'] = '';
            $result['product_name'] = '';
            $result['product_slug'] = '';
            $result['product_type'] = '';
            $result['product_price'] = '';
            $result['product_image'] = '';
            $result['product_desc'] = '';
            $result['product_3d'] = '';
            // $object = new stdClass();
            $product_attr = collect([
                (object) array(
                    'id' => 0,
                    'product_id' => 0,
                    'sku' => null,
                    'qty' => null,
                    'price' => null,
                    'image' => null,
                )
            ]);
            $result['product_attr'] = $product_attr;
            // var_dump($result);die;

        }
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        return view('admin/manage_product', $result);
    }
    public function manage_product_process(Request $request)
    {
        // return $request->file('image');
        // die;
        $id = $request->post('id');
        if ($id) {
            $product_image = "mimes:jpeg,png,jpg";
            $product_image_required = '';
            $image = '';
        } else {
            $product_image = 'required|mimes:jpeg,png,jpg';
            $product_image_required = 'required';
            $image = 'required|mimes:jpg,png,jpeg';
        }
        $request->validate(
            [
                'category_id' => 'required||not_in:0',
                'product_name' => 'required',
                'product_image' => $product_image_required,
                'product_slug' => 'required|unique:products,product_slug,' . $request->post('id'),
                'product_type' => 'required',
                'product_price' => 'required',
                'product_desc' => 'required',
                'sku.0' => 'required',
                'price.0' => 'required',
                'qty.0' => 'required',
                'image.0' => $image,
            ],
            [
                'category_id.required' => 'The category name field is required.',
                'sku.0.required' => 'required*',
                'price.0.required' => 'required*',
                'qty.0.required' => 'required*',
                'image.0.required' => 'required*',
            ]
        );
        $paid_arr = $request->post('paid');
        $sku_arr = $request->post('sku');
        $qty_arr = $request->post('qty');
        $price_arr = $request->post('price');
        $image_arr = $request->file('image');

        foreach ($sku_arr as $key => $sku_val) {
            if ($request->hasfile('image')) {
                $random = uniqid();
                $image_arr = $request->file('image');
                $ext_arr[$key] = $image_arr[$key]->extension();
                $image_name[$key] = $random . "." . $ext_arr[$key];
                $image_arr[$key]->storeAs($this->front_assets . '/product_attr_images', $image_name[$key]);
                $image[$key] = $image_name[$key];
                // var_dump($image);die;
            } else {
                $image = array([]);
            }
            $check = DB::table('products_attr')->where('sku', '=', $sku_arr[$key])->where('id',  '!=', $paid_arr[$key])->get();
            if (isset($check[0])) {
                notify()->success('sku_error', $sku_arr[$key] . 'sku already used.');
                return redirect(request()->headers->get('referer'));
            }
        }

        if ($id) {
            $model = Product::find($id);
            $message = 'Product Updated Successfully';
        } else {
            $model = new Product();
            $message = 'Product Inserted Successfully';
        }
        if ($request->hasfile('product_image')) {
            $image = $request->file('product_image');
            $ext = $image->extension();
            $image_name = time() . "." . $ext;
            $image->storeAs($this->front_assets . '/products', $image_name);
            $model->product_image = $image_name;
        }
        $model->product_name = $request->post('product_name');
        $model->product_slug = $request->post('product_slug');
        $model->category_id = $request->post('category_id');
        $model->product_type = $request->post('product_type');
        $model->product_price = $request->post('product_price');
        $model->product_desc = $request->post('product_desc');
        $model->product_3d = $request->post('product_3d');
        $model->status = 1;
        $model->save();
        $pid = $model->id;

        /*Product Attr*/
        foreach ($sku_arr as $key => $sku_val) {
            // var_dump($image);die;
            $product_attr_arr['product_id'] = $pid;
            $product_attr_arr['sku'] = $sku_arr[$key];
            $product_attr_arr['qty'] = $qty_arr[$key];
            $product_attr_arr['price'] = $price_arr[$key];
            if ($request->hasfile('image')) {
                $product_attr_arr['image'] = $image;
            }

            if ($paid_arr[$key] != 0 || '') {
                DB::table('products_attr')->where(['id' => $paid_arr[$key]])->update($product_attr_arr);
            } else {
                DB::table('products_attr')->insert($product_attr_arr);
            }
        }

        /*prosuct Attr ends */
        //images
        $images_data;
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                // var_dump($file);die;
                $image_name = uniqid();
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $file->storeAs($this->front_assets . '/product_images', $image_full_name);
                $images_data[] = $image_full_name;
            }
            $uploaded_before = DB::table('products')->select('images')->where('id', '=', $pid)->first();
            if ($uploaded_before) {
                // dd($images_data);
                DB::table('products')->where(['id' => $pid])->update([
                    'images' => serialize($images_data)
                ]);
            } else {
                $product = Product::find($pid);
                $product->images = serialize($images_data);
                $product->save();
            }
        }
        notify()->success($message);
        return redirect('admin/product');
    }
    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        notify()->success('Product Deleted Successfully.');
        return redirect('admin/product');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Status Updated Successfully.');
        return redirect('admin/product');
    }
}
