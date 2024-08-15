<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTabs;
use App\Models\User;
use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\CurrentEmployee;
use DateTime;
use Auth;


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
    public function index(Request $request)
    {
        

$totalProject = Project::count();

$totalClient = Client::count();

$totalEmployee = CurrentEmployee::count();


$totalProjectAmount = Project::sum('totalproject_amount');


$totalRecieved = Invoice::sum('received_amount');

$totalPending = Project::sum('totalproject_amount') - Invoice::sum('received_amount');

// dd($totalPending);

// dd($totalClient);
// $totalProject = Projects::count();

return view('admin.dashboard', ['totalProject' => $totalProject , 'totalClient' => $totalClient , 
'totalEmployee' => $totalEmployee ,  'totalProjectAmount' => $totalProjectAmount , 'totalRecieved' => $totalRecieved , 'totalPending' => $totalPending ]);


        // return view("admin.dashboard");
    }





}























//$input = $request->all();
        //$user_id = auth()->user()->id;
        //$date = date('Y-m-d H:i:s');
        //expires = new \DateTime('NOW');
        //$login_time = new \DateTime('NOW');
        // $login_user_data = auth()->user();
        // $user = new UserTabs;
        // $user->user_id = Auth::id();
        // $user->date = date('Y-m-d');
        // if ($login_user_data->status == 1) {
           
        //     $user->login_time = new \DateTime('NOW');
            
        // }
        
             
            
        //     $user->logout_time = new \DateTime('NOW');
            
        
        // $user->logout_time = new \DateTime('NOW');
        // $user->save();
        
        //dd($user);
      
        // $user = new UserTabs;
        // $user->user_id = auth()->user()->id;
        // $user->date = $input['date'];
        // $user->type = $input['type'];
        // $user->login_time = $input['login_time'];
        // $user->logout_time = $input['logout_time'];
        // $user->save();
        
        //$data= ['user'=>$user];