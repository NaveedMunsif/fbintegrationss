<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }
    public function getall(Request $request)
    {
         $data = Post::where('userID',Auth::user()->id)->orderby('id', 'desc')->get();

         return DataTables::of($data)
            ->addColumn('action', function ($q) {
                $id = encrypt($q->id);
                return '
                <a href="javascript:void(0)" data-toggle="modal" data-id="' . $id . '" data-target=".add_modal" class="btn btn-success  openaddmodal" ><i class="fas fa-pencil-alt"></i></a>
                <a href="javascript:void(0)" data-toggle="modal" data-id="' . $id . '" class="btn btn-danger delete_record" ><i class="fas fa-trash-alt"></i></a>
                <a href="javascript:void(0)"  data-id="' . $id . '" class="btn btn-info  publishToProfile" ><i class="fab fa-facebook-square"></i></a>';
            })->addColumn('name', function ($q) {
                return $q->name;
            })->addColumn('image', function ($q) {
                if(!empty($q->image)){
                    if (File::exists(public_path('/images/'.$q->image))) {
                        $image =$q->image;
                    }else {
                      $image = '';
                    }
                }else{
                    $image = '';
                }
                if (in_array($q->file_type, array("jpg", "jpeg", "png", "gif")))  {
                    return '<img src="'.url("public/images/".$image).'" class="rounded float-left" style=" width: 55px;" alt="...">';
                }else{
                    return '<video width="55" height="100"controls>
                        <source src="'.asset("public/images/".$image).'" type="video/mp4">
                        <source src="'.asset("public/images/".$image).'" type="video/ogg">
                        <source src="'.asset("public/images/".$image).'" type="video/webm">
                        <object data="'.asset("public/images/".$image).'" width="470" height="255">
                        <embed src="'.asset("public/images/".$image).'" width="470" height="255">
                        </object>
                    </video>';
                }
            })->addColumn('message', function ($q) {
                return $q->message;
            }) ->addColumn('status', function ($q) {
                $id = encrypt($q->id);
                if ($q->status == 'active') {
                    return ' <a  class="badge badgesize badge-success right changestatus" data-status="inactive" data-id="' . $id . '" href="javascript:void(0)">' . ucwords($q->status) . '</a>';
                }
                if ($q->status == 'inactive') {
                    return '<a class="badge badgesize badge-danger right changestatus"  data-status="active"  data-id="' . $id . '" href="javascript:void(0)">' . ucwords($q->status) . '</a>';
                }
            })->addIndexColumn()
            ->rawColumns(['status', 'action', 'image'])->make(true);
    }

    public function getmodal(Request $request)
    {
        $data = array();
        if (isset($request->id) && $request->id != '') {
            $id = decrypt($request->id);
            $data = Post::where('id',$id)->first();
        }

        return view('post.getmodal', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('image') || !empty($input['name']) || !empty($input['message']) ) {
            try {
                if (isset($request->id)) {
                    $id = decrypt($request->id);
                    $msg =  'updated successfully';
                    $data = Post::find($id);
                    if ($request->hasFile('image')) {
                        if(file_exists(public_path('images/'.$data->image)) && $data->image!='') {
                            unlink(public_path('images/'.$data->image));
                        }
                    }
                }else{
                    $msg =  'Added successfully';
                    $data = new Post;
                }
                if ($request->hasFile('image')) {

                    $destinationPath = public_path().'/images/';
                    $file = $input['image'];
                    $fileName = rand(11111, 99999) . '_'.$file->getClientOriginalName();
                    $extension =$file->getClientOriginalExtension();

                    $file->move($destinationPath, $fileName);
                    //dd($fileName);
                    $data->image = $fileName;
                    $data->file_type = $extension;

                }

                $data->name = $input['name'];
                $data->message = $input['message'];
                $data->userID = Auth::user()->id;
                $data->save();
                $arr = array("status" => 200, "msg" => $msg);

            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }
        }
        return \Response::json($arr);
    }
}
