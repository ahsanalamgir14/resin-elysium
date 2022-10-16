<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use MenaraSolutions\Geographer\State;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = User::where(['role' => 'customer'])->get();
        return view('admin.customers', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
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
            // 'address' => 'required|max:255',
            // 'mobile' => 'required|max:255',
            // 'city' => 'required|max:255',
            // 'state' => 'required|max:255',
            // 'country' => 'required|max:255',
            // 'zip_code' => 'required|max:255',
        ]);

        $user = User::where(['id' => $id])->first();
        $data = $request->all();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->role = $data['role'];
        $user->address = $data['address'];
        $user->mobile = $data['mobile'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->zip_code = $data['zip_code'];
        $user->status = 1; //to be added
        $user->save();
        notify()->success('User Updated Successfully');
        return back();
    }

    public function create()
    {
        $earth = new Earth();
        $data['countries'] = $earth->getCountries()->useShortNames()->toArray();
        return view('admin.create.customer', $data);
    }

    public function show($id = NULL)
    {
        if ($id) {
            $earth = new Earth();
            $data['customer'] = User::where(['id' => $id])->first();
            $data['countries'] = $earth->getCountries()->useShortNames()->toArray();
        }
        return view('admin.show.customer', $data);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        notify()->success('User Deleted Successfully.');
        return redirect()->back();
    }

    public function status(Request $request, $status, $id)
    {
        $model = User::find($id);
        $model->status = $status;
        $model->save();
        notify()->success('Customer Updated Successfully.');
        return redirect('admin/customer');
    }

    public function get_user_details(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(['status' => true, 'data' => $user]);
    }
}
