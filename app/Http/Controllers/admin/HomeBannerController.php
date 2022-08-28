<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('die index');
        $result['data'] = HomeBanner::all();
        return view('admin/home_banners', $result);
    }

    public function create()
    {
        return view('admin.create.banner');
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
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'required',
            'image' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/banners', $image_name);
            $data['image'] = $image_name;
        }
        HomeBanner::create($data);
        return redirect('admin/manage-banners');
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
        $data = HomeBanner::find($id);
        return view('admin.show.banner', $data);
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
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'required',
            // 'image' => 'required',
        ]);
        $data = $request->all();
        $banner = HomeBanner::where(['id' => $id])->first();
        if ($request->hasFile('image')) {
            unlink('storage/banners/' . $banner->image);
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs('public/banners', $image_name);
            $data['image'] = $image_name;
        }
        $banner->update($data);
        return redirect('admin/manage-banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = HomeBanner::find($id);
        if (Storage::disk('public')->exists('banners/' . $banner->image)) {
            unlink('storage/banners/' . $banner->image);
        }
        $banner->delete();
        notify()->success('Banner Deleted Successfully');
        return redirect()->back();
    }

    public function manage_home_banner($id = NULL)
    {
        if ($id) {
            $arr = HomeBanner::where(['id' => $id])->get();
            $result['id'] = $arr[0]->id;
            $result['name'] = $arr[0]->name;
            $result['image'] = $arr[0]->image;
            $result['btn_text'] = $arr[0]->btn_text;
            $result['btn_link'] = $arr[0]->btn_link;
            $result['status'] = $arr[0]->status;
        } else {
            $result['id'] = 0;
            $result['name'] = '';
            $result['image'] = '';
            $result['btn_text'] = '';
            $result['btn_link'] = '';
            $result['status'] = '';
        }
        return view('admin/manage_home_banner', $result);
    }
    public function manage_home_banner_process(Request $request)
    {
        // dd($request);
        $id = $request->post('id');
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        if ($id) {
            $model = HomeBanner::find($id);
            $message = 'Banner Updated Successfully';
        } else {
            $model = new HomeBanner();
            $message = 'Banner Inserted Successfully';
            // var_dump($model);die;
        }
        $model->name = $request->post('name');
        // dd($model); 
        $model->btn_text = $request->post('btn_text');
        $model->btn_link = $request->post('btn_link');
        if ($request->hasfile('image')) {
            $random = uniqid();
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $random . "." . $ext;
            $image->storeAs($this->front_assets . '/banners', $image_name);
            $model->image = $image_name;
        }
        $model->status = 1;
        $model->save();
        notify()->success($message);
        return redirect('/admin/home_banner');
    }
    public function delete(Request $request, $id)
    {
        $model = HomeBanner::find($id);
        $model->delete();
        notify()->success('Banner Deleted Successfully.');
        return redirect('/admin/home_banner');
    }
    public function status(Request $request, $status, $id)
    {
        $model = HomeBanner::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Status Updated Successfully.');
        return redirect('/admin/home_banner');
    }
}
