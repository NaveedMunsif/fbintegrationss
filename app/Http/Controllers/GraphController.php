<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Facebook\Facebook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GraphController extends Controller
{
    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            $fb->setDefaultAccessToken(Auth::user()->token);
            $this->api = $fb;
            return $next($request);
        });
    }


    public function facebook_page_id(Request $request)
    {

        $input = $request->all();
        $rules = [
            'facebook_page_id'=> 'required'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            $arr = ['status' =>400, "msg" => $validator->errors()->first(), 'result'=>[]];
        }else {
            try {


                $response = $this->api->get('/me/accounts', Auth::user()->token);

                $pages = $response->getGraphEdge()->asArray();
                $savePageName = User::where('id', Auth::user()->id)->first();

                foreach ($pages as $key) {

                    if ($key['id'] == $request->facebook_page_id) {

                        $savePageName->pagename =  $key['name'];
                        $savePageName->pagecategory = ( $key['category']);
                        $savePageName->save();
//
                    }
                }
                $user = User::find(Auth::id());
                $user->facebook_page_id = $request->facebook_page_id;
                $user->save();
                $msg ='page id update successfully';
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













    public function retrieveUserProfile(){
        try {

            $params = "first_name,last_name,age_range,gender";

            $user = $this->api->get('/me?fields='.$params)->getGraphUser();

            dd($user);

        } catch (FacebookSDKException $e) {

        }

    }
    public function retrievePageInsight(){
        $page_id = Auth::user()->facebook_page_id??'';
        try {
                $response = $this->api->get(
                     $page_id .'/insights?metric=page_engaged_users,page_impressions,page_fans',
                    $this->getPageAccessToken($page_id)
                );
                $response = $response->getGraphEdge()->asArray();
//            GraphNodeFactory::makeGraphEdge();

            $engaged_users=array();$page_impressions=array();$page_fans=array();

            foreach($response as $result){
//                dd($result['values'][1]['value']);

                if ($result['name']=="page_engaged_users"){
                    $data=array();
                    $data['title']=$result['title'];
                    $data['value']=$result['values'][1]['value'];
                    $engaged_users[$result['period']]=$data;
//                    array_push($engaged_users,$data2);

                }
                if ($result['name']=="page_impressions"){
                    $data=array();
                    $data['title']=$result['title'];
                    $data['value']=$result['values'][1]['value'];
                    $page_impressions[$result['period']]=$data;
//                    array_push($engaged_users,$data2);

                }
                if ($result['name']=="page_fans"){
                    $data=array();
                    $data['title']=$result['title'];
                    $data['value']=$result['values'][1]['value'];
                    $page_fans[$result['period']]=$data;
//                    array_push($engaged_users,$data2);

                }
            }
            return view('home',compact('engaged_users','page_impressions','page_fans'));

            } catch (Exception $e) {
            $engaged_users=array(
                "day" => array(
                    "title" => "Daily Page Engaged Users","value" => "0"
                ),
                "week" => array(
                    "title" => "Weekly Page Engaged Users","value" => "0"
                ),
                "days_28" => array(
                    "title" => "28 Days Page Engaged Users","value" => "0"
                ),
            );$page_impressions=array(
                "day" => array(
                    "title" => "Daily Total Impressions","value" => "0"
                ),
                "week" => array(
                    "title" => "Weekly Total Impressions","value" => "0"
                ),
                "days_28" => array(
                    "title" => "28 Days Total Impressions","value" => "0"
                ),
            );$page_fans=array(
                "day" => array(
                    "title" => "Lifetime Total Likes","value" => "0"
                )
            );

            return view('home',compact('engaged_users','page_impressions','page_fans'));
        }
    }

    public function publishToProfile(Request $request){
        try {
            $id = decrypt($request->id);
            $getdata = Post::find($id);

            if (!empty($getdata)) {
                $response = $this->api->post('/me/feed', [
                    'message' => $getdata->message
                ])->getGraphNode()->asArray();
                if($response['id']){
                    dump($response['id']);
                    // dd($response);
                    // post created
                }
            }else {

                dd('record not found');
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function getPageAccessToken($page_id){
        try {
             // Get the \Facebook\GraphNodes\GraphUser object for the current user.
             // If you provided a 'default_access_token', the '{access-token}' is optional.
             $response = $this->api->get('/me/accounts', Auth::user()->token);

        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        try {
            $pages = $response->getGraphEdge()->asArray();

            foreach ($pages as $key) {
                if ($key['id'] == $page_id) {
                    return $key['access_token'];
                }
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function publishToPage(Request $request){

        $page_id = Auth::user()->facebook_page_id??'';

//        dd($this->getPageAccessToken($page_id));
        try {
            if ($page_id && Auth::user()->token) {

                $id = decrypt($request->id);
                $getdata = Post::find($id);

                if (in_array($getdata->file_type, array("mp4", "mov", "wmv", "avi", "avchd", "flv","swf", "f4v", "mkv", "webm", "html5", "mpeg-2")))  {
                    $type1= 'videos';
                    $type2 = 'description';
                }else{
                    $type1 = 'photos';
                    $type2 = 'message';
                }

                if ($getdata->fb_post_id) {
                    $post = $this->api->post('/' . $getdata->fb_post_id , array($type2 => $getdata->message), $this->getPageAccessToken($page_id));
                }else{
                    $post = $this->api->post('/' . $page_id . '/' . $type1, array($type2 => $getdata->message, 'source' => $this->api->fileToUpload(public_path('images/'.$getdata->image))), $this->getPageAccessToken($page_id));
                }

                $post = $post->getGraphNode()->asArray();

                if (empty($getdata->fb_post_id)) {
                    if ($post) {
                        $getdata->fb_post_id = $post['post_id']??$post['id'];
                        $getdata->fb_id = $post['id'];
                        $getdata->save();
                        $status_code= 200;
                        $msg = 'Ctrated on facebook post successfully';
                    }else{
                        $msg='your post was not created in facebook.';
                        $status_code= 400;
                    }
                }else{
                    if ($post['success'] == true) {
                        $msg = 'Updated on facebook post successfully';
                        $status_code= 200;
                    }else{
                        $msg = 'your post was not updated in facebook.';
                        $status_code= 400;
                    }
                }
            }else {
                if (empty(Auth::user()->token)) {
                    $msg='please generate  facebook token. > Go to <a href="'.url("/profile").'">profile</a>.';
                }else{
                    $msg='please add facebook page id > Go to <a href="'.url("/profile").'">profile</a>.';
                }
                $status_code= 400;
            }
            $arr = array("status" => $status_code, "msg" => $msg);
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;
            $status_code= 400;
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {

            if ($ex->getcode()== 100) {
                $id = decrypt($request->id);
                $getdata = Post::find($id);
                $getdata->fb_post_id = null;
                $getdata->fb_id = null;
                $getdata->save();
                $this->publishToPage($request->id);
            }
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;
            $status_code= 400;
            $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
        }
        // return response()->json($arr, $status_code)->header('Content-Type', 'text/plain');
        return \Response::json($arr);
    }
    public function postDelete(Request $request){

        $page_id = Auth::user()->facebook_page_id??'';

        try {
            if ($page_id && Auth::user()->token) {

                $id = decrypt($request->id);
                $getdata = Post::find($id);
                if($getdata->fb_post_id== null){
                    $getdata->delete($id);
                    $msg = 'Deleted  post on facebook successfully';
                    $status_code= 200;

                }
                else{
                    if (in_array($getdata->file_type, array("mp4", "mov", "wmv", "avi", "avchd", "flv","swf", "f4v", "mkv", "webm", "html5", "mpeg-2")))  {
                        $type1= 'videos';
                        $type2 = 'description';
                    }else{
                        $type1 = 'photos';
                        $type2 = 'message';
                    }
                    if ($getdata->fb_post_id) {
                        $post = $this->api->delete('/' . $getdata->fb_post_id, array($type2 => $getdata->message), $this->getPageAccessToken($page_id));


                        $getdata->delete($id);
                    }

                    if ( true) {
                        $msg = 'Deleted  post on facebook successfully';
                        $status_code= 200;
                    }else{
                        $msg = 'your post was not deleted in facebook.';
                        $status_code= 400;
                    }
                }


            }
            else {
                if (empty(Auth::user()->token)) {
                    $msg='please generate  facebook token. > Go to <a href="'.url("/profile").'">profile</a>.';
                }else{
                    $msg='please add facebook page id > Go to <a href="'.url("/profile").'">profile</a>.';
                }
                $status_code= 400;
            }
            $arr = array("status" => $status_code, "msg" => $msg);
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];

            endif;
            $status_code= 400;
            $arr = array("status" => 400, "msg" => $msg, "result" => array());

        } catch (Exception $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;
            $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());

            $getdata = Post::find($id);
            if($msg == "Unsupported delete request. Object with ID '".$getdata->fb_post_id."' does not exist, cannot be loaded due to missing permissions, or does not support this operation. Please read the Graph API documentation at https://developers.facebook.com/docs/graph-api"){

                $getdata->delete($id);
                $status_code= 400;
                $msg="Deleted  post on facebook successfully";
                $arr = array("status" => $status_code, "msg" => $msg);

            }
        }
        return \Response::json($arr);

    }


}

