<?php

namespace App\Http\Controllers;

use App\Absence_letter;
use App\User;
use App\Location;
use App\House;
use App\Overtime;
use DateTime;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use PDF;

use Illuminate\Support\Facades\File;

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
    //index
    public function index()
    {
        $house_product = House::get();
        $Location = Location::get();
        $User = User::get();
        return view('layouts.home',compact('house_product','Location','User'));
    }
    //profile
    public function ShowProfile(){
        $letter_form = Absence_letter::where('user_id',Auth::user()->id)->get();
        $overTime = Overtime::where('user_id',Auth::user()->id)->get();
        return view('layouts.profile',compact('letter_form','overTime'));
    }
    //edit profile
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
    //change avatar
    public function EditAvatar(Request $req){
        $image = $req->file('image');
        if ($req->hasFile('image')) {
            $image->move('dist/img', $image->getClientOriginalName('myFile')); //save images at resource/image
            User::where('id',Auth::user()->id)->update(['avatar'=>$image->getClientOriginalName('myFile')]);
            return redirect()->back()->with('Update-Avatar','Update Avartar successfull');
        }

    }
    //Create letter
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
    //admin layout
    public function Admin(){
        $letter = Absence_letter::get();
        $user_name  =  User::get();
        $letter_form = array();
        $salary = User::get();
        $overTime =array();
        $overTimeEm = Overtime::get();
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
        foreach($overTimeEm as $ot_item){
            $user_ot = User::where('id',$ot_item->user_id)->first();
            $object_ot = (object)[
                        'id'                =>      $ot_item->id,
                        'user_name'         =>      $user_ot->name,
                        'date_ot'           =>      $ot_item->date_ot,
                        'start_time'        =>      $ot_item->start_time,
                        'end_time'          =>      $ot_item->end_time,
                        'place_ot'          =>      $ot_item->place_ot,
                        'task_name'         =>      $ot_item->task_name,
                        'note'              =>      $ot_item->note,
                        'status'            =>      $ot_item->status,
                        'created_at'        =>      $ot_item->created_at,
                        'updated_at'        =>      $ot_item->updated_at
                    ];
            array_push($overTime,$object_ot);
        }
        return view('layouts.admin-function',compact('letter_form','salary','user_name','overTime'));
    }
    //Approve the letter
    public function Approve(Request $req){
        if($req->id_letter){
            $letter = Absence_letter::where('id',$req->id_letter)->first();
            $user = User::where('id',$letter->user_id)->first();
            $diff = abs(strtotime($letter->to_date) - strtotime($letter->from_date));
            $min = floor($diff / (60*60*24));
            if($user->total_holidays>0){
                $user->total_holidays -= ($min+1);
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
    //reject the letter
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
    //Calendar
    public function Calender(){
        $date = Absence_letter::where('user_id',Auth::user()->id)->where('status','approved')->get();
        $ot = Overtime::where('user_id',Auth::user()->id)->get();
        $calendars = array();
        foreach($date as $item){
            $object = (object)[
                'reason'            =>              $item->reason,
                'from_date'         =>              $item->from_date,
                'to_date'           =>              date('Y-m-d', strtotime( $item->to_date. ' + 1 days'))
            ];
            array_push($calendars,$object);
        }
        return view('layouts.calender',compact('calendars','ot'));
    }
    //add salary using jquery ajax
    public function AddSalary(Request $req){
        if($req->id){
            User::where('id',$req->id)->update(['salary'=>$req->salary]);
            // $user->salary = $req->salary;
            // $user->save();
            echo"success";
        }else{
            echo "failed";
        }
    }
    public function PrintPDF(Request $req){
        $user = User::find($req->id_pdf);
        $dayof = 0;
        $dayLess = 0;
        $dayWork = 0;
        $absence = Absence_letter::where('user_id', $user->id)->get();
        $overTime = Overtime::where('user_id', $user->id)->get();
        $time = 0;
        foreach($overTime as $time_ot){
            $time += (strtotime($time_ot->end_time) - strtotime($time_ot->start_time))/60/60;
        }
        foreach($absence as $item){
            $date = new DateTime($item->from_date);
            $date->modify('last day of this month');
            $date2 = new DateTime($item->from_date);
            $date2->modify('first day of this month');
            $lastDay = $date->format('Y-m-d');
            $firstDay = $date2->format('Y-m-d');
            if(strtotime($lastDay)>strtotime($item->to_date)){
                $dayof = ((strtotime($item->to_date . "+ 1 days") - strtotime($item->from_date)) / 60 / 60 / 24);//Absence total
                $dayWork = ((strtotime($lastDay."+ 1 days") - strtotime($firstDay)) / 60 / 60 / 24) - $dayof;//total work
            }else if(strtotime($lastDay)>strtotime($item->to_date)){
                $dayof = ((strtotime($$lastDay."+ 1 days") - strtotime($item->from_date)) / 60 / 60 / 24);// Absence total when from_date bigger than last day of this month
                $dayWork = ((strtotime($$lastDay."+ 1 days") - strtotime($firstDay)) / 60 / 60 / 24)-$dayof;//total work
            }
        }
        $pdf = PDF::loadView('PDF.salary-report', compact('user','dayof','dayWork','time'));
        return $pdf->download('Salary-'.$user->name.'.pdf');
    }

    //add more table House layout
    public function HouseAdd(){
        $location = Location::get();
        return view('layouts.add_house',compact('location'));
    }

    // add to table House
    public function addHouse(Request $req){
        $this->validate($req,[
            "house_name"=>"required",
            "house_type"=>"required",
            "house_details"=>"required",
            "house_address"=>"required|max:50",
            "image"=>"required"
        ]);
        $image = $req->file('image');
        $house = new House();
        $Location = Location::where('location_name',$req->location_name)->first();
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        if ($req->hasFile('image')) {
            $image->move('images', $image->getClientOriginalName('myFile')); //save images at resource/image
        }
        $house->house_image = $image->getClientOriginalName('myFile'); //Image
        $house->save();
        return redirect()->back()->with('reportUpdate', 'Add '.$house->house_name.'Successfull');
    }
    //table admin
    public function simple(Request $req)
    {
        if($req->has('Name')){
            $house_product = House::orderBy('house_name',$req->Name)->paginate(9)->appends('Name',$req->Name);

        }
        else if($req->has('Id')){
            $house_product = House::orderBy('id',$req->Id)->paginate(9)->appends('Id',$req->Id);

        }
        else if($req->has('Created_at')){
            $house_product = House::orderBy('created_at',$req->Created_at)->paginate(9)->appends('Created_at',$req->Created_at);

        }else if($req->has('Updated_at')){
            $house_product = House::orderBy('updated_at',$req->Updated_at)->paginate(9)->appends('Updated_at',$req->UpDated_at);

        }else{
            $house_product = House::paginate(9);

        }
        if($req->has('NameOfLocation')){
            $Location = Location::orderBy('location_name',$req->NameOfLocation)->paginate(10)->appends('NameOfLocation',$req->NameOfLocation);

        }
        else if($req->has('IdOfLocation')){
            $Location = Location::orderBy('id',$req->IdOfLocation)->paginate(10)->appends('IdOfLocation',$req->IdOfLocation);

        }else{
            $Location = Location::paginate(10);

        }
        if($req->has('NameOfUser')){
            $User = User::orderBy('name',$req->NameOfUser)->paginate(4)->appends('Name',$req->NameOfUser);
        }else if($req->has('IdOfUser')){
            $User = User::orderBy('id',$req->IdOfUser)->paginate(4)->appends('IdOfUser',$req->IdOfUser);
        }else if($req->has('Created_user_at')){
            $User = User::orderBy('created_at',$req->Created_user_at)->paginate(4)->appends('Created_user_at',$req->Created_user_at);
        }else if($req->has('Updated_user_at')){
            $User = User::orderBy('updated_at',$req->Updated_user_at)->paginate(4)->appends('Updated_user_at',$req->Updated_user_at);
        }else if($req->has('Login_user_at')){
            $User = User::orderBy('login_at',$req->Login_user_at)->paginate(4)->appends('Login_user_at',$req->Login_user_at);
        }else if($req->has('Logout_user_at')){
            $User = User::orderBy('logout_at',$req->Logout_user_at)->paginate(4)->appends('Logout_user_at',$req->Logout_user_at);
        }else{
            $User = User::paginate(4);
        }
        $array = array();
        foreach($house_product as $product){
            $loName = Location::where('id',$product->id_Location)->first();
            $object = (object)[
                "id"            =>  $product->id,
                "house_name"    =>  $product->house_name,
                "house_type"    =>  $product->house_type,
                "house_details" =>  $product->house_details,
                "house_address" =>  $product->house_address,
                "house_image"   =>  $product->house_image,
                "location_name" =>  $loName->location_name,
                'disable'       =>  $product->disable,
                "create_at"     =>  $product->created_at,
                "update_at"     =>  $product->updated_at
            ];
            array_push($array,$object);
        }
        return view('layouts.simple',compact('house_product','Location','User','array'));
    }
    //layout edit house
    public function HouseEdit(Request $req){
        $house = House::find($req->id_house);
        $location = Location::get();
        return view('layouts.update_house',compact('location','house'));
    }
    public function EditHouse(Request $req){
        $this->validate($req,[
            "house_name"=>"required",
            "house_type"=>"required",
            "house_details"=>"required",
            "house_address"=>"required|max:50",
            "image"=>"required"
        ]);
        $image = $req->file('image');
        $Location = Location::where('location_name',$req->location_name)->first();
        $house = House::find($req->id_house);
        $image_path = "images/" . $image->getClientOriginalName('myFile');
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        if ($image->getClientOriginalName('myFile') != "") {
            if ($req->hasFile('image')) {
                if (File::exists($image_path)) { //Check existing image
                    File::delete($image_path); //delete image in a file
                }
                $house->house_image = $image->getClientOriginalName('myFile'); //Image
                $image->move('images', $image->getClientOriginalName('myFile')); //save images at resource/image
            }
            $house->save();
            return redirect()->back()->with('reportUpdate', 'Update '.$house->house_name.'Successfull');
        }
    }
    //Update location
    public function updateLocation(Request $req){
        $location = Location::find($req->id_location);
        return view('layouts.update-location',compact('location'));
    }
    public function LocationUpdate(Request $req){
        $location = Location::where('location_name',$req->location_name)->first();
        $this->validate($req,[
            "location_name"=>"required",
            "parent_id"=>"required"
        ]);
        if(!$location){
            Location::where('id',$req->id_location)->update(['location_name'=>$req->location_name,'parent_id'=>$req->parent_id]);
            return redirect()->back()->with('Update-Location','Update Location susscessfull');
        }else{
            return redirect()->back()->with('Fail-Update-Location','Fail to update location because the location you enter is exixt');
        }

    }
    //delete houuse
    public function destroy(Request $req){
        House::destroy($req->id_house);
        return redirect()->back()->with('Delete-House','Delete house successfully');
    }
    //delete Location
    public function destroyLocation(Request $req){
        $house = House::where('id_Location',$req->id_location)->get();
        foreach($house as $data){
            $data->delete();
        }
        Location::destroy($req->id_location);
        return redirect()->back()->with('report-Delete-Location','Delete Location susscessfull');
    }
    //delete user
    public function DestroyUser(Request $req){
        // $user = User::where('name',Auth::user()->name)->first();
        // if(!$user){
            User::destroy($req->user_id);
            return redirect()->back()->with('Delete-User','Delete user successfull');
        // }else{
        //     return redirect()->back()->with('Fail-Delete-User','user is loged in');
        // }

    }
    //Location add layout
    public function LocationAdd(){
        return view('layouts.add-location');
    }
    public function AddLocation(Request $req){
        $location = Location::where('location_name',$req->location_name)->first();
        $this->validate($req,[
            "location_name"=>"required",
            "parent_id"=>"required"
        ]);
        if(!$location){
            Location::create(['location_name'=>$req->location_name,'parent_id'=>$req->parent_id]);
            return redirect()->back()->with('Add-Location','Add Location susscessfull');
        }else{
            return redirect()->back()->with('Fail-Add-Location','Fails to add location because location have exist');
        }

    }
    //ajax add overtime for employees
    public function AddOverTime(Request $req){
        if($req->mem_id){
            $user = User::find($req->mem_id);
            Overtime::create(['user_id'=>$req->mem_id,
                            'date_ot'=>$req->date_ot,
                            'start_time'=>$req->from_time,
                            'end_time'=>$req->to_time,
                            'place_ot'=>$req->place_ot,
                            'task_name'=>$req->task_name,
                            'note'=>$req->note_ot]);
            echo "Set overtime for ".$user->name."  Success";
        }
    }
    //ajax update status overtime
    public function UpdateStatusOT(Request $req){
        if($req->id_ot){
            Overtime::where('id',$req->id_ot)->update(['note'=>$req->note_em,'status'=>$req->stas_em]);
            echo 'Update status success';
        }
    }
    //ajax disable location
    public function DisableLocation(Request $req){
        if($req->id_location){
            Location::where('id',$req->id_location)->update(['disable'=>1]);
            echo "Disable success";
        }
    }
    public function DisableHouse(Request $req){
        if($req->id_house){
            House::where('id',$req->id_house)->update(['disable'=>1]);
            echo "Disable success";
        }
    }

    //update user layout
    public function UserUpdate(Request $req){
        $user = User::find($req->user_id);
        return view('layouts.update-user',compact('user'));
    }
    //update user
    public function UpdateUser(Request $req){
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required'
        ]);
        $user = User::where('email',$req->email)->first();
        if(!$user){
            User::where('id',$req->user_id)->update(['name'=>$req->name,'email'=>$req->email]);
            return redirect()->back()->with('Update-User','Update user successfull');
        }else{
            return redirect()->back()->with('Fail-Update-User','User email is exist');
        }
    }
}
