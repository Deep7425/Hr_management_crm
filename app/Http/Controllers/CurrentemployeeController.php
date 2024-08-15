<?php

namespace App\Http\Controllers;
use App\Models\CurrentEmployee;
use App\Models\Language;
use App\Models\ProjectTeam;
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


class CurrentemployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'currentEmployee';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new CurrentEmployee(); 
        $this->sortableColumns = [
            0 => 'employee_name',
            1 => 'employee_code',
            2 => 'employee_department',
            3 => 'primarySkills',
            4 => 'secondarySkills',
            5 => 'primary_contact_number',
            6 => 'date_of_joining',
            7 => 'date_of_birth',
            8 => 'official_email_address',
            9 => 'aadhar_number',
            10 => 'document',
            11 => 'aadhar_number',
            12 => 'emergency_contact_number',
            13 => 'status',
        ];
    }

    public function index(request $request)
    { 
        
        if ($request->ajax()) {   
                    
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $filter = $request['filter'] ?? null;
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $status = $request['status'] ?? null;
            $employee_name = $request['employee_name'] ?? null;
            $employee_code = $request['employee_code'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $min = $request['min'] ?? null ;
            $max = $request['max'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 2; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$status,$start_date,$end_date,$user_type,$filter,$min,$max,$employee_name);
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
                $row['employee_name'] = isset($value->employee_name)? $value->employee_name:'N/A';
                $row['employee_code'] = isset($value->employee_code)? $value->employee_code:'N/A';
                $row['employee_department'] = isset($value->employee_department)? $value->employee_department:'N/A';
                $row['primarySkills'] = isset($value->primarySkills)? $value->primarySkills:'N/A';
                $row['secondarySkills'] = isset($value->secondarySkills)? $value->secondarySkills:'N/A';
                $row['primary_contact_number'] = isset($value->primary_contact_number)? $value->primary_contact_number:'N/A';
                $row['date_of_joining'] = isset($value->date_of_joining)? $value->date_of_joining:'N/A';

                $row['date_of_birth'] = isset($value->date_of_birth)? $value->date_of_birth:'N/A';
                
                $row['official_email_address'] = isset($value->official_email_address)? $value->official_email_address:'N/A';
                $row['personal_email_address'] = isset($value->personal_email_address)? $value->personal_email_address:'N/A';


                $row['aadhar_number'] = isset($value->aadhar_number)? $value->aadhar_number:'N/A';

                $row['document'] = isset($value->document)? $value->document:'N/A';



                $row['emergency_contact_number'] = isset($value->emergency_contact_number)? $value->emergency_contact_number:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                // $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();


                $row['status'] = typeAction($value->status, $value->id,[ 1=>'Working', 2=>'Left', 3 =>'Will Join', 4 =>'Absent', 5 =>'Under Discussion'],'typeAction',$this->page.'.status')->toHtml();

                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                $edit = editAction($this->page.'.edit',['id'=>$value->id]);
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
              
                $row['actions']=createAction($edit.$view.$delete);
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
       
        return view('admin.'.$this->page.'.listing',$data);
    }


    public function frontend()
    {   
        $employee = CurrentEmployee::where('user_type', '2')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.currentEmployee.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['currentEmployee'] = CurrentEmployee::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['primarySkills'] = Language::all();
        $data['secondarySkills'] = Secondarylanguages::all();
        $data['button'] = 'Save';
        $data= ['page'=>$this->page,'data'=>$data,'data'=>$data]; 

        return view('admin.'.$this->page.'.create',$data);
    }



    public function upload(Request $request)
    {
        // if ($request->hasFile('document')) {
        //     $file = $request->file('document');
        //     $filePath = $file->store('documents');
        //     $CurrentEmployee = new CurrentEmployee();
        //     $CurrentEmployee->document = $filePath;
        //     $CurrentEmployee->save();
        //     return redirect()->back()->with('success', 'Document uploaded successfully.');
        // }


        if ($request->file('document') != null) {
            $image = $request->file('document');
            $imageName = time() . $image->getClientOriginalName();
            $imageName = str_replace(' ', '', $imageName);
            $image->move(public_path('uploads/document'), $imageName);
            $CurrentEmployee = new CurrentEmployee();
            $CurrentEmployee->document = $imageName;
            $CurrentEmployee->save();
            return redirect()->back()->with('success', 'Document uploaded successfully.');
        }

        // Handle case when no file is uploaded
        return redirect()->back()->with('error', 'No document file uploaded.');
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
        $message = [];
        $validation = [
            'employee_name'          => 'required|max:190',
            'official_email_address'         => 'required|email|max:150|unique:current_employees,official_email_address|regex:/(.+)@(.+)\.(.+)/i', 
            'personal_email_address'         => 'required|email|max:150|unique:current_employees,personal_email_address|regex:/(.+)@(.+)\.(.+)/i', 
            'primary_contact_number' => 'required|numeric|unique:current_employees|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
            'emergency_contact_number' => 'numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
        ]; 
        $message = [];
            
        $this->validate($request,$validation,$message);       
        try{
        
            $data = new CurrentEmployee;



$data->employee_name = $input['employee_name'];

if (!empty($data->employee_name)) {
    // Get the total count of employees with non-empty names
    $employeeCount = CurrentEmployee::whereNotNull('employee_name')->count();

    // Set the employee code to 1011 plus the total count
    $data->employee_code = 1011 + $employeeCount;
} else {
    // Set the employee code to 1011 if no employee name is provided
    $data->employee_code = 1011;
}



            $data->employee_department = $input['employee_department'];
            $data->primarySkills = implode(',',$input['primarySkills']);
            $data->secondarySkills = implode(',',$input['secondarySkills']);
            
            $data->primary_contact_number = $input['primary_contact_number'];


            $data->date_of_joining = $input['date_of_joining'];
            
            $data->date_of_birth = $input['date_of_birth'];
            
            $data->official_email_address = $input['official_email_address'];

            $data->personal_email_address = $input['personal_email_address'];

            $data->aadhar_number = $input['aadhar_number'];


            
            // $data->document = $input['document'];


            
       if (isset($input['document'])) {
    $data->document = $input['document'];
          } else {
    $data->document = '';
             }


            $data->emergency_contact_number = $input['emergency_contact_number'];
            $data->status = 1;
            $data->user_type = 2;
            $data->role = 'HRmanager';
            if($data->save()){
                if(isset($input['primarySkills'])){
                    foreach($input['primarySkills'] as $skills){
                        $check_skill = Language::where('primarySkills',$skills)->first();
                        if($check_skill == null){
                            $language = new Language;
                            $language->primarySkills = $skills;
                            // $language->primarySkills = implode(',',$input['primarySkills']);
                            $language->save();
                        }
                
                    }
                }
                if(isset($input['secondarySkills'])){
                    foreach($input['secondarySkills'] as $skills){
                        $check_skill = Secondarylanguages::where('secondarySkills',$skills)->first();
                        if($check_skill == null){
                            $secLanguage = new Secondarylanguages;
                            $secLanguage->secondarySkills = $skills;
                            // $language->secondarySkills = implode(',',$input['secondarySkills']);
                            $secLanguage->save();
                        }
                        // dd($check_skill);
                    }
                }
                



                if(isset($input['employee_name'])){
                    $team = new ProjectTeam;
                    $team->employee_name = $input['employee_name'];
                    $team->save();
                    //dd($team);
                }
                



                if(isset($data)){
                    
                    $randomPassword = $this->randomPassword();
                    $update_user = [
                        'status' => 1,
                        'password' => Hash::make($randomPassword)
                      ];
                    $secretKey = encryptPass($data->id.Config::get('global.secret_string').Config::get('global.secret_string').$input['primary_contact_number'].Config::get('global.secret_string'));
                         
                    $email = EmailTemplateLang::where('email_id', 2)->select(['name', 'subject', 'description','footer'])->first();
                
                    $description = str_replace("[EMAIL]", $data->official_email_address, $email->description);
                    
                    $description = str_replace("[PASSWORD]", $randomPassword, $description);
                
                    $name = $request->employee_name;
             
                $register_detail=(object)[];
                $register_detail->description = $description;
                $register_detail->footer = $email->footer;
                $register_detail->employee_name = $name;
                $register_detail->subject = $email->subject;
                 
                
                }
            }
               
         return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            // dd($e);
            return customeRedirect('admin.'.$this->page.'.index','','error',$e);                       
        }
    }


    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
      }

    public function store_old(Request $request)
    {
       
        
        $input = $request->all();
        $mesasge = [
            'employee_name.required' => "Name field is required.",
            'official_email_address.required' => "Email field is required.",
            'official_email_address.email' => "Please enter valid email.",
            'official_email_address.unique' => "Email is already taken.",

            'personal_email_address.required' => "Email field is required.",
            'personal_email_address.email' => "Please enter valid email.",
            'personal_email_address.unique' => "Email is already taken.",
            'primary_contact_number.required' => "Mobile number field is required.",
            'primary_contact_number.digits' => "Mobile number must be in 10 digits only.",

        ];

        
        $this->validate($request, [
            'employee_name' => 'required|max:255',

            'official_email_address' => 'required|email|max:150|unique:current_employees,official_email_address|regex:/(.+)@(.+)\.(.+)/i',
            'personal_email_address' => 'required|email|max:150|unique:current_employees,personal_email_address|regex:/(.+)@(.+)\.(.+)/i',
            'primary_contact_number' => 'required|numeric|unique:current_employees,primary_contact_number|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
            'emergency_contact_number' => 'numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
            
            
        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new CurrentEmployee;
                // if ($request->file('image')) {
                //     $file = $request->file('image');
                //     $result = file_upload($file, 'user');
                //     if ($result[0] == true) {
                //         // dd($result);
                //         $data->image = $result[1];
                //     }
                // }
                $data->employee_name = $input['employee_name'];
                $data->employee_code = $input['employee_code'];
                $data->employee_department = $input['employee_department'];
                $data->primarySkills = $input['primarySkills'];
                $data->secondarySkills = $input['secondarySkills'];
                $data->primary_contact_number = $input['primary_contact_number'];
                $data->date_of_joining = $input['date_of_joining'];


                $data->date_of_birth = $input['date_of_birth'];


                $data->official_email_address = $input['official_email_address'];
                //$data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
                $data->status = 1;
                $data->personal_email_address = $input['personal_email_address'];

                $data->aadhar_number = $input['aadhar_number'];

                $data->document= $input['document'];
                
                $data->emergency_contact_number = $input['emergency_contact_number'];
                $data->type = 2;
                $data->role = 'HRmanager';
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
        $data = $this->Models->where('current_employees.id',$id)->first();
        // dd($data);
        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.show',$data);
    }

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

        $data['selected_primarySkills'] = explode(',',$data->primarySkills);   
        $data['selected_secondarySkills'] = explode(',',$data->secondarySkills);

         $data['primarySkills'] = Language::all();
         $data['secondarySkills'] = Secondarylanguages::all();
         $data['button'] = 'Update';
         
         
 
        $data= ['page'=>$this->page,'data'=>$data,'data'=>$data,'data'=>$data];
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
            'employee_name'     => 'required|max:190',
            'official_email_address' => 'required|max:190|email|unique:current_employees,official_email_address, '. $data->id . ',id',
            'primary_contact_number' => 'required|numeric|digits:10|unique:current_employees,primary_contact_number, '. $data->id . ',id',
            'personal_email_address' => 'required|max:190|email|unique:current_employees,personal_email_address, '. $data->id . ',id',
            'primary_contact_number.required' => "Mobile number field is required.",
            'primary_contact_number.digits' => "Mobile number must be in between 10 digits only.",
            
        ];  

        
        // dd($input, $data);     
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
           
            //dd($$input['primarySkills']);
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.currentEmployee.index')->with('success',"Record updated successfully.");

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
            'employee_name.required' => __("backend.name_required"),
            'official_email_address.required' => __("backend.email_required"),
            'official_email_address.email' => __("backend.email_email"),
            'official_email_address.unique' => __("The email has already been taken."),
            'primary_contact_number.required' => __("backend.mobile_required"),
            

        ];
        $this->validate($request, [
            'employee_name' => 'required|max:255',
            'official_email_address' => 'required|email|max:150|regex:/(.+)@(.+)\.(.+)/i|unique:current_employees,official_email_address,' . $id,
            'primary_contact_number' => 'required|numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/|unique:current_employees,primary_contact_number,' .$id,
            'personal_email_address' => 'required|email|max:150|regex:/(.+)@(.+)\.(.+)/i|unique:current_employees,personal_email_address,' . $id,
            'emergency_contact_number' => 'numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
            
        ], $mesasge);

        $input = $request->all();

       
        $fail = false;         
         
        if (!$fail) {
            $file = $request->file('image');

            try {
                if (isset($file)) {
                    $result = file_upload($file, 'user');                 
                    $data = CurrentEmployee::where('id', $id)->update(['employee_name' => $input['employee_name'], 'employee_code' => $input['employee_code'],'employee_department' => $input['employee_department'],'primarySkills' => implode(',',$input['primarySkills']),'secondarySkills' => implode(',',$input['secondarySkills']),'primary_contact_number' => $input['primary_contact_number'],'date_of_joining' => $input['date_of_joining'],'date_of_birth' => $input['date_of_birth'],'official_email_address' => $input['official_email_address'],'aadhar_number' => $input['aadhar_number'],   'document' => $input['document'], 'emergency_contact_number' => $input['emergency_contact_number'],'image' => $result[1]]);
                    
                } else {
                    $data = CurrentEmployee::where('id', $id)->update(['employee_name' => $input['employee_name'], 'employee_code' => $input['employee_code'], 'employee_department' => $input['employee_department'],'primarySkills' => implode(',',$input['primarySkills']),'secondarySkills' => implode(',',$input['secondarySkills']),'primary_contact_number' => $input['primary_contact_number'],'date_of_joining' => $input['date_of_joining'], 'date_of_birth' => $input['date_of_birth'], 'official_email_address' => $input['official_email_address'],'aadhar_number' => $input['aadhar_number'], 'document' => $input['document'], 'emergency_contact_number' => $input['emergency_contact_number']]);
                }
                return Redirect::route('admin.currentEmployee.index')->with('success',"Record updated successfully.");
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
        $data =  CurrentEmployee::findOrFail($id)->delete();
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
            if ($status == 'working') {
                $inp = ['status' => 1];
            }
            else if ($status == 'Left') {
                $inp = ['status' => 2];
            }
            else if ($status == 'Will Join') {
                $inp = ['status' => 3];
            } 
            else if ($status == 'Absent') {
                $inp = ['status' => 4];
            }
            
            else if ($status == 'Under Discussion') {
                $inp = ['status' => 5];
            }
            
            
            else {
                $inp = ['status' => 0];
            }


            $User = CurrentEmployee::findOrFail($id);
            if ($User->update($inp)) {
                if ($status == 'working') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 1;
                }
                
                if ($status == 'left') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 2;
                }
                if ($status == 'will_join') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 3;
                }
                if ($status == 'absent') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 4;
                }
                if ($status == 'under_discussion') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['status'] = 5;
                }
                
                
                else {
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

