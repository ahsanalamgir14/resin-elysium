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
        notify()->success('Category Created Successfully');
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
        notify()->success('Category Updated Successfully');
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
        notify()->success('Category Deleted Successfully');
        return redirect()->back();
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
