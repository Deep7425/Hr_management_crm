<?php

namespace App\Http\Controllers;
use App\Models\CurrentEmployee;
use App\Models\Language;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\Task;
use App\Models\Client;
use App\Models\Secondarylanguages;
use App\Models\Candidate;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;
use File;
use DB;
use Auth;
use Illuminate\Support\Facades\Config;
use App\Models\EmailTemplateLang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Courts;
use Spatie\Permission\Models\Role;
// use App\Exports\FacilityOwnerExport;
use App\Models\PasswordReset as ModelsPasswordReset;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;


class ProjectHiringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'projectss';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Project(); 
        $this->sortableColumns = [
            0 => 'client_id',
            1 => 'client_name',
            2 => 'project_name',
            3 => 'team_member',
            4 => 'project_award_date',
            5 => 'total_amount',
            6 => 'milestone_name',
            7 => 'milestone_details',
            8 => 'percentage_project_amount',
            9 => 'totalproject_amount',
            10 => 'milestone_details',
            11 => 'due_date',
            12 => 'status',
        ];

        
    }

    public function index(request $request)
    { 
        //$client_id = $request->client_id;
       //dd($client_id);
        
        if ($request->ajax()) {       
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            //$filter = $request['filter'] ?? null;
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 3; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$status,$start_date,$end_date,$user_type);
            $totaldata = $querydata->count();
            $response = $querydata;
          
            $response = $response->offset($start)
                    ->limit($limit)
                    ->get();

            if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }
            
            $datas = array();
            $i = 1;
            foreach ($data as $value) {

                $row['id'] = $i;
                $row['client_name'] = isset($value->client_name)? $value->client_name:'N/A';
                $row['project_name'] = isset($value->project_name)? $value->project_name:'N/A';
                $row['team_member'] = isset($value->team_member)? $value->team_member:'N/A';

                $row['project_award_date'] = isset($value->project_award_date)? $value->project_award_date:'N/A';
                $row['total_amount'] = isset($value->total_amount)? $value->total_amount:'N/A';
                $row['milestone_name'] = isset($value->milestone_name)? $value->milestone_name:'N/A';
                $row['milestone_details'] = isset($value->milestone_details)? $value->milestone_details:'N/A';
                $row['percentage_project_amount'] = isset($value->percentage_project_amount)? $value->percentage_project_amount:'N/A';
                $row['totalproject_amount'] = isset($value->totalproject_amount)? $value->totalproject_amount:'N/A';
                $row['due_date'] = isset($value->due_date)? $value->due_date:'N/A';
               
                $row['role'] = isset($value->role)? $value->role:'N/A';
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                //$row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();


                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                $edit = editAction($this->page.'.edit',['id'=>$value->id]);
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$task = taskAction($this->page.'.task',['project_id'=>$value->id]);
              
                $row['actions']=createAction($edit.$view);
                $datas[] = $row;
                $i++;
                unset($u);
            }
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($totaldata),
                "recordsTotal" => intval($totaldata),
                "data" => $datas
            ];
            return $return;
        }
        if(isset($request->user_type)){
            $user_type = $request->user_type;

        }else{
            $user_type = null;
        }
        if(isset($request->status)){
            $status = $request->status;

        }else{
            $status = null;
        }
      
        $data= ['page'=>$this->page,'user_type'=>$user_type,'status'=>$status];
       //dd($data);
        return view('admin.'.$this->page.'.listing',$data);
    }


    public function frontend()
    {
        $project = Project::where('user_type', '3')->get();
        $data= ['page'=>$this->page,'project'=>$project]; 
        return view('admin.projectss.listing', $data);
    }
    
    

    public function edit_frontend($id)
    {
        $data['project_name'] = Project::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        
         $data = Client::latest()->first();
        if(isset($data) && $data != null){


            $milestone_name = $data->milestone_name;
            
            
            $milestone_name1 = explode(" ",$milestone_name);
           
            // dd(gettype($milestone_name1[0]));
            $milestone_name2 = 1;
             
            //$project = substr($pro, -3);
        
             //dd($project);
            $new_milestone_name_number = $milestone_name2;
            //dd($new_milestone_name_number);
        
        }else{
            //$project = substr($pro, -3);
            $new_milestone_name_number = '1';
        }
        $data['selected_team_member'] = explode(',',$data->team_member);
        $data['currentEmployee'] = CurrentEmployee::all();
        $all_client_name = Client::where('status',1)->get();
        //dd($all_client_name);
       
        //dd($data);
        
        $data= ['page'=>$this->page,'data'=>$data,'new_milestone_name_number'=>$new_milestone_name_number, 'all_client_name'=>$all_client_name];         
        return view('admin.'.$this->page.'.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    { 
         //dd($request->all());
        $input = $request->all();
       
         //dd($input);
        //sent mail to payment user
        //$message = [];
        $validation = [
            'project_name'          => 'required|max:190',
            'client_name'          => 'required|max:190',
            // 'official_email_address'         => 'required|email|unique:current_employees,official_email_address|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            // 'personal_email_address'         => 'required|email|unique:current_employees,personal_email_address|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            // 'primary_contact_number' => 'required|numeric|unique:current_employees|digits:10|regex:/^([1-9][0-9\s\-\+\(\)]*)$/',
            // //'emergency_contact_number' => 'required|numeric|unique:current_employees|digits:10|regex:/^([1-9][0-9\s\-\+\(\)]*)$/',
            // 'emergency_contact_number.digits' =>'The mobile number must be between 10 digits.',
            
        ]; 
        // $message = [
        //     'primary_contact_number.digits' =>'The mobile number must be between 10 digits.',
            
        // ];
            
        $this->validate($request,$validation);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
          
            //dd($input);
            $data = new Project;
            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $result = image_upload($file, 'user');
            //          //dd($result);
            //     if ($result[0] == true) {
            //         $data->image = $result[1];
            //     }
            // }
            //$data->client_id = $input['client_id'];
            $data->client_name = $input['client_name'];
            $data->project_name = $input['project_name'];
            $data->team_member = implode(',',$input['team_member']);
           
            $data->project_award_date = $input['project_award_date'];
            $data->total_amount = $input['total_amount'];
            
            $data->milestone_name = implode(',',$input['milestone_name']);
            $data->milestone_details = implode(',',$input['milestone_details']);
            $data->percentage_project_amount = implode(',',$input['percentage_project_amount']);
            $data->totalproject_amount = implode(',',$input['totalproject_amount']);
            $data->due_date = implode(',',$input['due_date']);
            
           
            //$data->primarySkills = implode(',',$input['primarySkills']);
            //$data->secondarySkills = implode(',',$input['secondarySkills']);
            
            //$data->task_name = $input['task_name'];
            //$data->test_cases = $input['test_cases'];
            //$data->assign_task = $input['assign_task'];
            //$data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
            //$data->primarySkills = implode(',',$input['primarySkills']);
            //if(isset($data->secondarySkills)){
            //$data->secondarySkills = implode(',',$input['secondarySkills']);
            //}
            $data->status = 1;
            $data->user_type = 3;
            $data->role = 'hiringmanager';
            $data->save();
             //dd($data);
            return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
            return customeRedirect('admin.'.$this->page.'.index','','error',$e);                       
        }
    }


    public function store_old(Request $request)
    {
        // Gate::authorize('subadmin-create');
        // validate
        $input = $request->all();
        $mesasge = [
            'project_name.required' => "Name field is required.",
            // 'official_email_address.required' => "Email field is required.",
            // 'official_email_address.email' => "Please enter valid email.",
            // 'official_email_address.unique' => "Email is already taken.",

            // 'personal_email_address.required' => "Email field is required.",
            // 'personal_email_address.email' => "Please enter valid email.",
            // 'personal_email_address.unique' => "Email is already taken.",
            // 'primary_contact_number.required' => "Mobile number field is required.",
            //  'primary_contact_number.digits' => "Mobile number must be in 10 digits only.",
             //'image.size'  =>  "Image is too large.",
        ];
        $this->validate($request, [
            'project_name' => 'required|max:255',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            // 'official_email_address' => 'required|email|unique:current_employees,official_email_address',
            // 'personal_email_address' => 'required|email|unique:current_employees,personal_email_address',
            // 'primary_contact_number' => 'required|digits:10|unique:current_employees,primary_contact_number',
            //'emergency_contact_number' => 'required|digits:10|unique:current_employees,emergency_contact_number',
            
            
            
        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new Project;
                // if ($request->file('image')) {
                //     $file = $request->file('image');
                //     $result = image_upload($file, 'user');
                //     if ($result[0] == true) {
                //         // dd($result);
                //         $data->image = $result[1];
                //     }
                // }
                $data->client_id = $input['client_id'];
                $data->client_name = $input['client_name'];
                $data->project_name = $input['project_name'];
                $data->team_member = implode(',',$input['team_member']);
                $data->project_award_date = $input['project_award_date'];
                $data->total_amount = $input['total_amount'];
                $data->milestone_name = implode(',',$input['milestone_name']);
                $data->milestone_details = implode(',',$input['milestone_details']);
                $data->percentage_project_amount = implode(',',$input['percentage_project_amount']);
                $data->totalproject_amount = implode(',',$input['totalproject_amount']);
                $data->due_date = implode(',',$input['due_date']);
                $data->type = 3;
                $data->role = 'hiringmanager';
                $data->save();
                // set permissions
                    /*$restro_permissions = ['148', '149', '150', '151', '163', '164', '165', '166'];
                    foreach ($restro_permissions as $key => $value) {
                        $user = User::findOrFail($data->id);
                        $user->givePermissionTo($value);
                    }*/
                // end permissions
                // forgot password start
                $record = $data;
                $token = Str::random(60);
                $email =  $record->email;
                $user = ModelsPasswordReset::where('email', $email)->first();
                if (!isset($user)) {
                    $user = new ModelsPasswordReset;
                    $user->email = $email;
                    $user->token = $token;
                    $user->save();
                } else {
                    ModelsPasswordReset::where('email', $email)->update(['token' => $token]);
                }
                $user = ModelsPasswordReset::where('email', $email)->first();

                // send email start
                $email = EmailTemplateLang::where('email_id', 3)->where('lang', 'en')->select(['name', 'subject', 'description', 'footer'])->first();
                $description = $email->description;
                $description = str_replace("[NAME]", $facility_owner->name, $description);
                $name = $email->name;
                $name = str_replace("[NAME]", $facility_owner->name, $name);
                $record = (object)[];
                $record->description = $description;
                $record->footer = $email->footer;
                $record->name = $name;
                $record->subject = $email->subject;
                $record->user_email = $user->email;
                $record->user_token = $user->token;

                Mail::send('emails.welcome', compact('record'), function ($message) use ($facility_owner, $email) {
                    $message->to($facility_owner->email, config('app.name'))->subject($email->subject);
                    $message->from('dev.inventcolabs@gmail.com', config('app.name'));
                });
                // send email end
                // forgot password end
                $result['message'] = 'Record added successfully.';
                $result['status'] = 1;
                return response()->json($result);
            } catch (Exception $e) {
                $result['message'] = 'Something went wrong';
                $result['status'] = 0;
                return response()->json($result);
            }
        } else {
            $result['message'] = 'Something went wrong';
            $result['status'] = 0;
            return response()->json($result);
        }
        return response()->json($result);
    }
     

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $data = $this->Models->where('projects.id',$id)->first();
        
        //dd($data);
        if(isset($data) && $data != null){


            $milestone_name = $data->milestone_name;
            
            
            $milestone_name1 = explode(" ",$milestone_name);
           
            // dd(gettype($milestone_name1[0]));
            $milestone_name2 = 1;
             
            //$project = substr($pro, -3);
        
             //dd($project);
            $new_milestone_name_number = $milestone_name2;
            //dd($new_milestone_name_number);
        
        }else{
            //$project = substr($pro, -3);
            $new_milestone_name_number = '1';
        }
        
        $data['selected_team_member'] = explode(',',$data->team_member);
        
        $data['milestone_name'] = explode(',',$data->milestone_name);
        $data['milestone_details'] = explode(',',$data->milestone_details);
        $data['percentage_project_amount'] = explode(',',$data->percentage_project_amount);
        $data['totalproject_amount'] = explode(',',$data->totalproject_amount);
        $data['due_date'] = explode(',',$data->due_date);
        
         
        
        $data['currentEmployee'] = CurrentEmployee::all();
        $all_client_name = Client::where('status',1)->get();
        // dd($data);
        $data= ['page'=>$this->page,'data'=>$data,'new_milestone_name_number'=>$new_milestone_name_number,'all_client_name'=>$all_client_name];
        return view('admin.'.$this->page.'.show',$data);
    }
    
    // public function taskshow(Request $request)
    // {
    //     $id = $request->id;
    //     $data = $this->ModelsTask->where('tasks.id',$id)->first();
    //     // dd($data);
    //     $data= ['page'=>$this->page,'data'=>$data];
    //     return view('admin.'.$this->page.'.taskshow',$data);
    // }
   
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        $id = $request->id;
        $data = $this->Models->find($id);
        
        //$data = Project::first();
        //dd($data);
        if(isset($data) && $data != null){


            $milestone_name = $data->milestone_name;
            
            
            $milestone_name1 = explode(" ",$milestone_name);
           
            // dd(gettype($milestone_name1[0]));
            $milestone_name2 = 1;
             
            //$project = substr($pro, -3);
        
             //dd($project);
            $new_milestone_name_number = $milestone_name2;
            //dd($new_milestone_name_number);
        
        }else{
            //$project = substr($pro, -3);
            $new_milestone_name_number = '1';
        }
       
        $data['selected_team_member'] = explode(',',$data->team_member);
       
        $data['milestone_name'] = explode(',',$data->milestone_name);
        $data['milestone_details'] = explode(',',$data->milestone_details);
        $data['percentage_project_amount'] = explode(',',$data->percentage_project_amount);
        $data['totalproject_amount'] = explode(',',$data->totalproject_amount);
        $data['due_date'] = explode(',',$data->due_date);
        
        $data['currentEmployee'] = CurrentEmployee::all();
        $all_client_name = Client::where('status',1)->get();
        
 
        $data= ['page'=>$this->page,'data'=>$data,'new_milestone_name_number'=>$new_milestone_name_number,'all_client_name'=>$all_client_name];
        // dd($data);
        return view('admin.'.$this->page.'.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_old(Request $request)
    {     
        $data = $this->Models->find($request->id);
        $input = $request->all();
        $message = [];       
        $validation = [
            'project_name'     => 'required|max:190',
            
            
        ];  

        
        // dd($input, $data);     
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
           
            //dd($$input['primarySkills']);
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.projectss.index')->with('success',"Record updated successfully.");

        } catch (Exception $e) {
            return Redirect::Back()->with('error',__('backend.something_went_wrong'));
        }
    }
    public function update(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        // validate
        //dd($request->all());
        $id = $request->id;
        
        $mesasge = [
            
            
            

        ];
        $this->validate($request, [
           
            
        ], $mesasge);

        $input = $request->all();

       
        //dd($input);
        //$data->secondarySkills = $input['secondarySkills'];
        $fail = false;         
         
        if (!$fail) {
            $file = $request->file('image');

            try {
                if (isset($file)) {
                    $result = image_upload($file, 'user');                 
                    $data = Project::where('id', $id)->update(['due_date' => implode(',',$input['due_date']),'image' => $result[1]]);
                    
                } else {
                    $data = Project::where('id', $id)->update(['due_date' => implode(',',$input['due_date'])]);
                }
                return Redirect::route('admin.projectss.index')->with('success',"Record updated successfully.");
            } catch (Exception $e) {
                return Redirect::Back()->with('error',"Something went wrong.");
            }
        } else {
            return Redirect::Back()->with('error',"Something went wrong.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data =  Project::findOrFail($id)->delete();
        $data= ['page'=>$this->page,'data'=>$data];
        // dd($data);
        //Gate::authorize('subadmin-delete');
        
        return view('admin.'.$this->page.'.listing',$data);
       
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data =  Task::findOrFail($id)->delete();
        $data= ['page'=>$this->page,'data'=>$data];
        // dd($data);
        //Gate::authorize('subadmin-delete');
        
        return view('admin.'.$this->page.'.listing',$data);
       
    }

    public function status(Request $request)
    {
        $id = $request->id;
        try {
            $data = $this->Models->findOrFail($id);
            $data->status = $request->value;
            $data->save();
            return ['status'=>1,'type'=>'success','message'=>'Status update Successfully.'];
        } catch (ModelNotFoundException $e) {
            return ['status'=>0,'type'=>'danger','message'=>'Something went wrong.'];
        }
    }

    public function changeStatus($id, $status)
    {
        $details = CurrentEmployee::find($id);
        if (!empty($details)) {
            if ($status == 'active') {
                $inp = ['status' => 1];
            } else {
                $inp = ['status' => 0];
            }
            $User = CurrentEmployee::findOrFail($id);
            if ($User->update($inp)) {
                if ($status == 'active') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 1;
                } else {
                    $result['message'] = __("backend.Facility_Owner_status_deactivate");
                    $result['status'] = 1;
                }
            } else {
                $result['message'] = __("backend.Facility_Owner_status_can`t_updated");
                $result['status'] = 0;
            }
        } else {
            $result['message'] = __("backend.Invaild_user");
            $result['status'] = 0;
        }
        return response()->json($result);
    }
}
