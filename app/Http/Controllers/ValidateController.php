<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;

class ValidateController extends Controller
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
    public function LocationVali(Request $req){
        if($req->get('location_name')){
            $location_name = $req->location_name;
            $location = Location::where('location_name',$location_name)->first();

            if($location){
                $location_name_val = strtolower($location->location_name);
                $location_name_val_req = strtolower($location_name);
                if($location_name_val == $location_name_val_req){
                    echo '<label style="color:red">Location is exist </label>';
                }
            }
            else{
                echo '<label style="color:green">You can use this location</label>';
            }
        }
        if($req->emailCheck){
            $email = $req->emailCheck;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<label style="color:red">email is invalid!</label>';
            }
        }
        if($req->get('email')){
            $email = $req->email;
            $email_val = strtolower($email);
            $user = User::where('email',$email_val)->first();
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<label style="color:red">email is invalid!</label>';
            }else if($user){
                echo '<label style="color:red">Email is exist </label>';
            }else{
                echo '<label style="color:green">You can use this email</label>';
            }
        }
    }
    public function EmName(Request $req){
        if($req->name){
            $query = $req->name;
            $data = User::where('name', 'LIKE', "%{$query}%")
                    ->get();
            if($data){
                $output = '<ul id="selectName" class="dropdown-menu ajax-list" style="display:block; position:absolute ">';
                foreach($data as $row)
                {
                    $output .= '
                    <li class="item">'.$row->name.'</li><br>
                    ';
                }
                $output .= '</ul>';
                echo $output;
            }else{
                echo "Do not find any employees";
            }

        }
        else{
            echo "Do not find any employees";
        }
    }
}
