<?php

namespace App\Http\Controllers;

use App\Absence_letter;
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
        $letter_form = Absence_letter::where('user_id',Auth::user()->id)->get();
        return view('layouts.profile',compact('letter_form'));
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
            $user->gender = $req->gender;
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
    public function CreateLetter(Request $req){
        if($req->id_member){
            $today = date("Y-m-d");
            $today_time = strtotime($today);
            $expire_time = strtotime($req->from_date);
            $to_time = strtotime($req->to_date);
            if($today_time<$expire_time){
                if($expire_time<$to_time){
                    $letter = new Absence_letter();
                    $letter->user_id = $req->id_member;
                    $letter->from_date = $req->from_date;
                    $letter->to_date = $req->to_date;
                    $letter->reason = $req->reason;
                    $letter->save();
                    echo('Send letter success');
                }else{
                    echo('To date bigger than from date');
                }
            }else{
                echo("Please creating your letter more than one day from now");
            }
        }
    }
    public function RealTimeData(Request $req){
        $letter = Absence_letter::where('user_id',$req->id)->get();
        $array_letter = array();
        foreach($letter as $item){
            $realtime = Absence_letter::where('created_at',$item->created_at)->first();
            $object =  array(
                            (string)date("Y-m-d",strtotime($item->created_at))=> (object)[
                                                        'Title'=>'leave of absence',
                                                        'reason'=>$realtime->reason,
                                                        'approve'=>$realtime->status,
                                                        'reason-disapprove'=> $realtime->reason_disapprove
                                                ]
                        );
            array_push($array_letter,$object);
        }
        return response()->json($array_letter);
    }
    public function Admin(){
        $letter = Absence_letter::get();
        $letter_form = array();
        foreach($letter as $item){
            $user = User::where('id',$item->user_id)->first();
            $object = (object)[
                        'id'                =>      $item->id,
                        'user_name'         =>      $user->name,
                        'reason'            =>      $item->reason,
                        'from_date'         =>      $item->from_date,
                        'to_date'           =>      $item->to_date,
                        'status'            =>      $item->status,
                        'reason_disapprove' =>      $item->reason_disapprove,
                        'created_at'        =>      $item->created_at,
                        'updated_at'        =>      $item->updated_at
                    ];
            array_push($letter_form,$object);
        }
        return view('layouts.admin-function',compact('letter_form'));
    }
    public function Approve(Request $req){
        if($req->id_letter){
            $letter = Absence_letter::where('id',$req->id_letter)->first();
            $user = User::where('id',$letter->user_id)->first();
            if($user->total_holidays>0){
                $user->total_holidays -= 1;
                $user->save();
                $letter->status = 'approved';
                $letter->save();
                echo("Aproved success");
            }else{
                $letter->status = 'dissapproved';
                $letter->save();
                echo("Fail because employee doesn't have holiday any  more");
            }
        }
        else{
            echo "fails";
        }
    }
    public function GetData(){
        $letter = Absence_letter::where('user_id',Auth::user()->id)->get();
        $array = array();
        foreach($letter as $item){
            $object = (object)[
                'from_date'   =>      $item->from_date,
                'to_date'     =>      $item->to_date
            ];
            array_push($array,$object);
        }
        return response()->json($array);
    }
    public function Dissapprove(Request $req){
        if($req->id_letter){
            $letter = Absence_letter::where('id',$req->id_letter)->first();
            $letter->status = 'reject';
            $letter->reason_disapprove = $req->reason;
            $letter->save();
            echo("reject success");

        }else{
            echo "fails";
        }
    }
    public function Calender(){
        $date = Absence_letter::where('id',Auth::user()->id)->where('status','approved')->get();
        $calendars = array();
        foreach($date as $item){
            $object = (object)[
                'reason'            =>              $item->reason,
                'from_date'         =>              $item->from_date,
                'to_date'           =>              date('Y-m-d', strtotime( $item->to_date. ' + 1 days'))
            ];
            array_push($calendars,$object);
        }
        return view('layouts.calender',compact('calendars'));
    }
}
