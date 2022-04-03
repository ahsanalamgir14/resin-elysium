<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = category::all();
        return view('admin/categories', $result);
    }
    
    public function create()
    {
        $result['categories'] = Category::all();
        return view('admin.create.category', $result);
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
            'slug' => 'required',
            'image' => 'required',
            'is_home' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/categories', $image_name);
            $data['image'] = $image_name;
        }
        Category::create($data);
        return redirect('admin/manage-categories');
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
        $data = Category::find($id);
        $data['categories'] = Category::where('id', '!=', $id)->get();
        return view('admin.show.category', $data);
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
            'slug' => 'required',
            // 'image' => 'required',
            'is_home' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $category = Category::where(['id' => $id])->first();
        if ($request->hasFile('image')) {
            unlink('storage/categories/' . $category->image);
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/categories', $image_name);
            $data['image'] = $image_name;
        }
        $category->update($data);
        return redirect('admin/manage-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        unlink('storage/categories/' . $category->image);
        $category->delete();
        return redirect()->back();
    }

    public function manage_category($id = NULL)
    {
        if ($id) {
            $arr = Category::where(['id' => $id])->get();
            $result['id'] = $arr[0]->id;
            $result['parent_id'] = $arr[0]->parent_id;
            $result['category_name'] = $arr[0]->category_name;
            $result['category_slug'] = $arr[0]->category_slug;
            $result['is_home'] = $arr[0]->is_home;
            $result['status'] = $arr[0]->status;
            $result['parent_name'] = DB::table('categories')->where(['id' => $arr[0]->parent_id])->where(['status' => 1])->pluck('category_name')->first();
        } else {
            $result['id'] = '';
            $result['parent_id'] = '';
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['is_home'] = '';
            $result['status'] = '';
            $result['parent_name'] = '';
        }
        $result['category'] = DB::table('categories')->where('id', '!=', $id)->where(['status' => 1])->get();
        return view('admin/manage_category', $result);
    }
    public function manage_category_process(Request $request)
    {
        $id = $request->post('id');
        if ($id) {
            $image_required = '';
            $model = Category::find($id);
            $message = 'Category Updated Successfully';
        } else {
            $image_required = 'required';
            $model = new Category();
            $message = 'Category Inserted Successfully';
        }
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,' . $request->post('id'),
            'cat_image' => $image_required,
            'is_home' => 'required',
            'status' => 'required',
        ]);
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        if ($request->post('parent_id')) {
            $model->parent_id = $request->post('parent_id');
        } else {
            $model->parent_id = 0;
        }
        if ($request->hasfile('cat_image')) {
            $random = uniqid();
            $image = $request->file('cat_image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs($this->front_assets . '/category', $image_name);
            $model->category_image = $image_name;
        }
        $model->is_home = $request->post('is_home');
        $model->status = $request->post('status');
        $model->save();
        notify()->success($message);
        return redirect('admin/category');
    }
    public function delete(Request $request, $id)
    {
        $model = Category::find($id);
        $model->delete();
        notify()->success('Category Deleted Successfully.');
        return redirect('admin/category');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Status Updated Successfully.');
        return redirect('admin/category');
    }
}
