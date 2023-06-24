<?php

namespace App\Http\Controllers;

use App\notes;
use App\User;
use App\userData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function adminhome(){

        return view('admin.home');
    }
    public function userView(Request  $request){

            $user_data = User::where('id', $request->user)->first();
            return view('admin.user_view',compact('user_data'));
    }
    public function userEdit(Request  $request){

            $user_delete = User::where('id',$request->id)->first();

        if($request->action == 0)
        {
            $user_delete->deleted = 0;
        }
        else{
            $user_delete->deleted = 1;
        }
            $user_delete->save();
             return redirect()->route('alluserlist');
    }



    public function addnewuser(Request $request){

        $epassword =  Hash::make($request->password);

        $save = new User();
        $save->name = $request->username;
        $save->email = $request->email;
        $save->password = $epassword;
        if($request->admin == 1)
        {
            $save->is_admin = 1;
        }
        $save->save();

        $userdata = new userData();
        $userdata->username = $request->username;
        $userdata->email = $request->email;
        $userdata->password = $request->password;
        $userdata->user_id = $save->id;
        $userdata->save();

        return redirect()->route('alluserlist');
    }
    public function alluserlist(){

        $alluserdata = User::where([
            ['is_admin', '!=',1],
            ['deleted', '!=',1]
        ])->get();
        return view('admin.alluserlist', compact('alluserdata'));
    }
    public function deletedUserList(){

        $alluserdata = User::where([
            ['is_admin', '!=',1],
            ['deleted', '!=',0]
        ])->get();
        return view('admin.alluserlist', compact('alluserdata'));
    }

    public function  alluserprofiles($id)
    {
        $userdata = User::where('id', $id)->first();
        $allnotes = notes::where('user_id', $id)->get();
        return view('allUserInfo', compact('userdata','allnotes'));
    }

    public function singleUsr(){

        $user = User::all();

        return view('alluserlist', compact('user'));

    }
    public function pagecategory(Request $request){



        $user = User::where('id', $request->currentuserid)->first();

//        $user = User::find(Auth::id());
        $user->pagecategory = $request->pagecategory;
        $user->save();

        return back();
    }
    public  function addnote(Request $request){


        $notesSave = new notes();
        $notesSave->user_id = Auth::user()->id;
        $notesSave->notetitle = $request->notetitle;
        $notesSave->notetext = $request->notetext;
        $notesSave->save();

            return back();
    }
    public  function getnotes(){
        $allnotes = notes::where('user_id', Auth::user()->id)->get();
        return  view('notes', compact('allnotes'));

    }
    public  function  delete($id){
        $deleterecord = notes::find($id);
        $deleterecord->delete();
        return back();
    }
}
