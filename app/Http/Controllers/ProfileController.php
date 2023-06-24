<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class ProfileController extends Controller
{

//
//    private $api;
//    public function __construct(Facebook $fb)
//    {
//        $this->middleware(function ($request, $next) use ($fb) {
//            $fb->setDefaultAccessToken(Auth::user()->token);
//            dd($fb);
//            $this->api = $fb;
//            return $next($request);
//        });
//    }


    public function companyname(Request $request){


        $user = User::find(Auth::id());
        $user->companyname = $request->companyname;
        $user->save();
    }



    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $rules = [
            'name'=> 'required'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            $arr = ['status' =>400, "msg" => $validator->errors()->first(), 'result'=>[]];
        }else {
            try {


                $user = User::find(Auth::id());
                $user->name = $request->name;
                if ($request->file('file')) {

                    $imagePath = $request->file('file');

                    $imageName = $imagePath->getClientOriginalName();
                    $path = request()->file->move(public_path('photos'), $imageName);
                    $user->image_name = '/photos/' . $imageName;
                }

                $user->save();
                $msg ='profile update successfully';
                $arr = array("status" => 200, "msg" => $msg );
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2]))
                {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg,"result" => array() );
            }
        }
        return \Response::json($arr);
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
            "public_profile, pages_show_list","read_insights", "pages_read_engagement", "pages_manage_posts", "pages_manage_metadata"/*, "user_videos", "user_posts"*/
        ])->redirect();
    }

    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user();

        DB::table('users')
              ->where('id', Auth::id())
              ->update([
                'token' => $auth_user->token,
                'facebook_app_id'  =>  $auth_user->id,
                  'fbname' => $auth_user->name,
                  'fbemail' => $auth_user->email,
                  'fbphoto' => $auth_user->avatar_original,
              ]);
        return redirect()->to('/setting');
    }



}
