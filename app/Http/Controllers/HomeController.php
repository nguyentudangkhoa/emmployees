<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.home');
    }
    public function ShowProfile(){
        return view('layouts.profile');
    }
    public function EditUser(Request $req){
        if($req->id_member){
            $user = User::where('id',$req->id_member)->first();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->address = $req->address;
            $user->identity_card = $req->identity_card;
            $user->issue_place = $req->issue_place;
            $user->issue_date = $req->issue_date;
            $user->university = $req->university;
            $user->granduate_year = $req->granduate_year;
            $user->start_job_at = $req->start_job_at;
            $user->birthday = $req->birthday;
            $user->note = $req->note;
            $user->save();
            echo "Edit profile ".$user->name." success";
        }
    }
    public function EditAvatar(Request $req){
        $image = $req->file('image');
        if ($req->hasFile('image')) {
            $image->move('dist/img', $image->getClientOriginalName('myFile')); //save images at resource/image
            User::where('id',Auth::user()->id)->update(['avatar'=>$image->getClientOriginalName('myFile')]);
            return redirect()->back()->with('Update-Avatar','Update Avartar successfull');
        }
        
    }
}
