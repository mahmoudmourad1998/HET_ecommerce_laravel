<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([User::with('profile')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'api_token' => Str::random(100),
      ]);
      //return $user;
      $profile = new Profile();
      $profile->user_id =  $user->id;
      $profile->ntf_token =  $request->ntf_token;
      $profile->save();
      $user['profile'] = $profile;
      return response()->json($user);
    }

    public static function NotifyAllUsers($product)
    //public static function NotifyAllUsers()
    {

      //$getTokenOwnerData = Profile::all()->with('user')->first();
      $query1 = DB::select('select * from profiles', []);
      $result_of_query1 = array_map(
        function ($value) {
          return (array) $value;
        },
        $query1
      );
      $users_ntf_tokens = [];
      foreach ($result_of_query1 as &$value) {
        $ntf_token = $value['ntf_token'];
        array_push($users_ntf_tokens, $ntf_token);
      }
      //return response()->json($users_ntf_tokens);

      $SERVER_API_KEY = 'AAAArSSF3HE:APA91bH8JY2fUIt8C5hu0ucwQAAgtznNUKWpV97W3DDqR9OXyQEYCGkh3-k1BLDfKGbXWrPh9FK4A1IJHk047swL2i7jTraAqN-hPpknNtm-F3E3fgN5smMFqKAGEWzutMUoNfgPGUa-';

      $data = [

        "registration_ids" => $users_ntf_tokens,

        "notification" => [
          //"title" => "Dear ".$getTokenOwnerData->user->name." Attention",
          //"body" => Auth::user()->name." Visited Your Profile",
          "sound"=>true,
          // 'image' => $request->image_url
          "title" => "Dear User, Check Our New Product",
          "body" => "A ".$product->name."With Just Only ".$product->price." $, Be Our First Buyer.",
        ],

        "data" => [
          'click_action'=> 'FLUTTER_NOTIFICATION_CLICK',
        ],

      ];

      $dataString = json_encode($data);

      $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

      ];

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

      curl_setopt($ch, CURLOPT_POST, true);

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

      curl_exec($ch);

      return response()->json('All Users Were Notified.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

  //login for one user
  public function UserLogin(Request $request)
  {
    //return $request->all();
    $credentials = $request->only('email', 'password');
    //return($credentials);
    $user = Auth::attempt($credentials);
    if($user){
      return response()->json(Auth::user());
    }
    else{
      return response()->json('unexpected error, please try later!');
    }
  }

  //logout for one user
  public function UserLogout()
  {
    Auth::logout();
    return response()->json('logout was successful');
  }
}
