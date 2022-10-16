<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class WebNotificationController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $result['categories'] = Category::with(['products', 'sub_categories', 'parents'])->where(['status' => 1])->get();
        return view('notification-view', $result);
    }
  
    public function storeToken(Request $request)
    {
        dd('store');
        auth()->user()->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }
  
    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
          
        // $serverKey = 'NCUThuPcp6-roV65NQBHwngtQdmoWDDGSk1AqCKwkp0';
        $serverKey = 'BPIl36UIhjVQwlt6g5XErxV1XSAche8q1U9kmXY4kooDIzvmkS6QxBgYRLxYYf5RBvnzO54SiBUirwi6oXX-PUQ';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);        
    }
}