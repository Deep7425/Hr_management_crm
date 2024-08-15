<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Client;
use App\Models\CurrentEmployee;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
// public function index(){

// $totalProject = Project::count();

// $totalClient = Client::count();

// $totalEmployee = CurrentEmployee::count();


// $totalProjectAmount = Project::sum('totalproject_amount');


// $totalRecieved = Invoice::sum('total_amount');

// $totalPending = Project::sum('totalproject_amount') - Invoice::sum('total_amount');

// // dd($totalPending);

// // dd($totalClient);
// // $totalProject = Projects::count();

// return view('admin.dashboard', ['totalProject' => $totalProject , 'totalClient' => $totalClient , 
// 'totalEmployee' => $totalEmployee ,  'totalProjectAmount' => $totalProjectAmount , 'totalRecieved' => $totalRecieved , 'totalPending' => $totalPending ]);

//     }
}
