<?php

namespace App\Http\Controllers;
use App\Models\Language;
use App\Models\Secondarylanguages;
use App\Models\Candidate;
use App\Models\CandidateDocument;
use App\Models\CandidateInformation;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;
use File,DB;
use PDF;
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


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'candidate';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Candidate(); 
        $this->sortableColumns = [
            0 => 'name',
            1 => 'email',
            2 => 'primary_mobile_number',
            3 => 'secondary_mobile_number',
            4 => 'years_of_experience',
            5 => 'primarySkills',
            6 => 'secondarySkills',
            7 => 'currentCompany',
            8 => 'ctc',
            9 => 'ectc',
            10 =>'role',
            //10 => 'status',
            //11 => 'created_at',
        ];


        $this->ModelsCandidateDocument = new CandidateDocument(); 
        $this->sortableColumnsCandidateDocument = [
            0 => 'aadhar_card',
            1 => 'bank_account_number',
            2 => 'bank_name',
            3 => 'status',
            
        ];

        $this->ModelsCandidateInformation = new CandidateInformation(); 
        $this->sortableColumnsCandidateInformation = [
            0 => 'school_university_name',
            1 => 'passout_year',
            2 => 'percentage',
            3 => 'status',
            
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
            $start_date = $request['start_date'] ?? null ;
            $min = $request['min'] ?? null ;
            $max = $request['max'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 2; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$status,$start_date,$end_date,$user_type,$filter,$min,$max);
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
                $row['name'] = isset($value->name)? $value->name:'N/A';
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['primary_mobile_number'] = isset($value->primary_mobile_number)? $value->primary_mobile_number:'N/A';
                $row['secondary_mobile_number'] = isset($value->secondary_mobile_number)? $value->secondary_mobile_number:'N/A';
                $row['years_of_experience'] = isset($value->years_of_experience)? $value->years_of_experience:'N/A';
                $row['year'] = isset($value->year)? $value->year:'N/A';
                $row['month'] = isset($value->month)? $value->month:'N/A';
                $row['primarySkills'] = isset($value->primarySkills)? $value->primarySkills:'N/A';
                $row['secondarySkills'] = isset($value->secondarySkills)? $value->secondarySkills:'N/A';
                $row['currentCompany'] = isset($value->currentCompany)? $value->currentCompany:'N/A';
                $row['ctc'] = isset($value->ctc)? $value->ctc:'N/A';
                $row['ectc'] = isset($value->ectc)? $value->ectc:'N/A';
                $row['linkedIn_URL'] = isset($value->linkedIn_URL)? $value->linkedIn_URL:'N/A';
                $row['notice_period'] = isset($value->notice_period)? $value->notice_period:'N/A';
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
                $document = documentAction($this->page.'.documentListing',['id'=>$value->id]);
                $information = infoAction($this->page.'.informationListing',['id'=>$value->id]);
                $pdf = '<a href="'.$value->image.'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                $row['actions']=createAction($edit.$view.$document.$information.$pdf);
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
        $candidate = Candidate::where('user_type', '2')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.candidate.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['candidate'] = Candidate::findOrFail($id);
        
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
        $data= ['page'=>$this->page,'data'=>$data,'data'=>$data];        
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
        $message = [];
        $validation = [
            'name'          => 'required|max:190',
            'email'         => 'required|email|unique:candidates|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            'primary_mobile_number' => 'required|numeric|unique:candidates|digits:10|regex:/^([1-9][0-9\s\-\+\(\)]*)$/',
            'primary_mobile_number.digits' =>'The mobile number must be between 10 digits.',
            
        ]; 
        $message = [
            'primary_mobile_number.digits' =>'The mobile number must be between 10 digits.',
            
        ];
            
        $this->validate($request,$validation,$message);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
          
            $data = new Candidate;
            if ($request->file('image')) {
                $file = $request->file('image');
                $result = file_upload($file, 'user');
                     //dd($result);
                if ($result[0] == true) {
                    $data->image = $result[1];
                }
            }
            
            $data->name = $input['name'];
            $data->email = $input['email'];
            $data->primary_mobile_number = $input['primary_mobile_number'];
            $data->secondary_mobile_number = $input['secondary_mobile_number'];
            $data->year = $input['year'];
            $data->month = $input['month'];
            $data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
            $data->primarySkills = implode(',',$input['primarySkills']);
            if(isset($data->secondarySkills)){
            $data->secondarySkills = implode(',',$input['secondarySkills']);
            }
            $data->currentCompany = $input['currentCompany'];
            $data->lastCompany = $input['lastCompany'];
            $data->remark = $input['remark'];
            $data->ctc = $input['ctc'];
            $data->ectc = $input['ectc'];
            $data->linkedIn_URL = $input['linkedIn_URL'];
            $data->notice_period = $input['notice_period'];
            $data->about_us = $input['about_us'];
            //$data->status = 1;
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
                        // dd($check_skill);
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
            }
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
            'name.required' => "Name field is required.",
            'email.required' => "Email field is required.",
            'email.email' => "Please enter valid email.",
            'email.unique' => "Email is already taken.",
            'primary_mobile_number.required' => "Mobile number field is required.",
             'primary_mobile_number.digits' => "Mobile number must be in 10 digits only.",
             'image.size'  =>  "Image is too large.",
        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:candidates,email',
            'primary_mobile_number' => 'required|digits:10|unique:candidates,primary_mobile_number',
            

        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new Candidate;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $result = file_upload($file, 'user');
                    if ($result[0] == true) {
                        // dd($result);
                        $data->image = $result[1];
                    }
                }
                $data->name = $input['name'];
                $data->email = $input['email'];
                $data->primary_mobile_number = $input['primary_mobile_number'];
                $data->secondary_mobile_number = $input['secondary_mobile_number'];
                $data->year = $input['year'];
                $data->month = $input['month'];
                $data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
                $data->primarySkills = $input['primarySkills'];
                $data->secondarySkills = $input['secondarySkills'];
                $data->currentCompany = $input['currentCompany'];
                $data->lastCompany = $input['lastCompany'];
                $data->remark = $input['remark'];
                $data->ctc = $input['ctc'];
                $data->ectc = $input['ectc'];
                $data->linkedIn_URL = $input['linkedIn_URL'];
                $data->notice_period = $input['notice_period'];
                $data->about_us = $input['about_us'];
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
        $data = $this->Models->where('candidates.id',$id)->first();
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
            'name'     => 'required|max:190',
            'email' => 'required|max:190|email|unique:candidates,email, '. $data->id . ',id',
            'primary_mobile_number' => 'required|numeric|digits:10|unique:candidates,primary_mobile_number, '. $data->id . ',id',
            'primary_mobile_number.required' => "Mobile number field is required.",
            'primary_mobile_number.digits' => "Mobile number must be in between 10 digits only.",
            
        ];  
        // dd($input, $data);     
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
           
            //dd($$input['primarySkills']);
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.candidate.index')->with('success',"Record updated successfully.");

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
            'name.required' => __("backend.name_required"),
            'email.required' => __("backend.email_required"),
            'email.email' => __("backend.email_email"),
            'email.unique' => __("The email has already been taken."),
            'primary_mobile_number.required' => __("backend.mobile_required"),
            

        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:candidates,email,' . $id,
            'primary_mobile_number' => 'required|numeric|digits:10|unique:candidates,primary_mobile_number,' .$id,
            
        ], $mesasge);

        $input = $request->all();
      
        //dd($input);
        //$data->secondarySkills = $input['secondarySkills'];
        $fail = false;         
         
        if (!$fail) {
            $file = $request->file('image');
          
            try {
                if (isset($file)) {
                    $result = file_upload($file, 'user');                 
                    $data = Candidate::where('id', $id)->update(['name' => $input['name'], 'email' => $input['email'],'primary_mobile_number' => $input['primary_mobile_number'],
                    'secondary_mobile_number' => $input['secondary_mobile_number'],'year' => $input['year'],'month' => $input['month'],
                    'years_of_experience' => $input['year'].'.'.$input['month'].' Years','primarySkills' => implode(',',$input['primarySkills']),
                    'secondarySkills' => implode(',',$input['secondarySkills']),'currentCompany' => $input['currentCompany'],'lastCompany' => $input['lastCompany'],'ctc' => $input['ctc'],'ectc' => $input['ectc'],'about_us' => $input['about_us'],
                    'linkedIn_URL' => $input['linkedIn_URL'],'remark' => $input['remark'],'notice_period' => $input['notice_period'],'image' => $result[1]]);
                    
                } else {
                    $data = Candidate::where('id', $id)->update(['name' => $input['name'], 'email' => $input['email'],'primary_mobile_number' => $input['primary_mobile_number'],
                    'secondary_mobile_number' => $input['secondary_mobile_number'],'year' => $input['year'],'month' => $input['month'],
                     'years_of_experience' => $input['year'].'.'.$input['month'].' Years','primarySkills' => implode(',',$input['primarySkills']),
                     'secondarySkills' => implode(',',$input['secondarySkills']),'currentCompany' => $input['currentCompany'],'ctc' => $input['ctc'],'ectc' => $input['ectc'],'about_us' => $input['about_us'],
                     'linkedIn_URL' => $input['linkedIn_URL'],'notice_period' => $input['notice_period']]);
                }
                return Redirect::route('admin.candidate.index')->with('success',"Record updated successfully.");
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
        $data =  Candidate::findOrFail($id)->delete();
        $data= ['page'=>$this->page,'data'=>$data];
        // dd($data);
        //Gate::authorize('subadmin-delete');
        
        return view('admin.'.$this->page.'.listing',$data);
       
    }
    public function pdfDownload(Request $request){
        $id = $request->all();
        //$data = Candidate::where('id',$id)->first();
        $data = Candidate::where('id',$id)->value('image');
        //dd($data);
        
        //return response()->download($data);
        $abc = Storage::loadView($data);
        return response()->file($abc);
        //dd($abc);
         //$data= ['page'=>$this->page,'data'=>$data,'data'=>$data,'abc'=>$abc];
         //return view('admin.'.$this->page.'.listing',$data);
      
       
        
    }

    public function documentListing(request $request){
             

            $candidate_id = $request->id;
            //dd($candidate_id);
        
        if ($request->ajax()) { 
            
            $candidate_id_ajax = $request->input('candidate_id');
            //dd($candidate_id_ajax);
            $data = $this->ModelsCandidateDocument->where('candidate_documents.candidate_id',$candidate_id_ajax)->get(); 
           //dd($data);
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $filter = $request['filter'] ?? null;
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $min = $request['min'] ?? null ;
            $max = $request['max'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 2; 
            $sortableColumnsCandidateDocument = $this->sortableColumnsCandidateDocument;            
            $querydata = $this->ModelsCandidateDocument->getModel($search, $sortableColumnsCandidateDocument[$orderby], $order,$start_date,$end_date,$status,$user_type,$filter,$min,$max,$candidate_id_ajax);
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
            //$data['project_id'] = $project_id;
            //dd($data);
            
            $i = 1;
            foreach ($data as $value) {
                //dd($data);
                $row['id'] = $i;
                $row['aadhar_card'] = isset($value->aadhar_card)? $value->aadhar_card:'N/A';
                $row['bank_account_number'] = isset($value->bank_account_number)? $value->bank_account_number:'N/A';
                $row['bank_name'] = isset($value->bank_name)? $value->bank_name:'N/A';
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();


                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                $edit = editAction($this->page.'.documentedit',['id'=>$value->id]);
                $view = viewAction($this->page.'.documentshow',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$document = documentAction($this->page.'.candidateDocumentInfo',['id'=>$value->id]);
                
                //$pdf = '<a href="'.$value->image.'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                $row['actions']=createAction($edit.$view);
                $datas[] = $row;
                $i++;
                unset($u);
            }
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($totaldata),
                "recordsTotal" => intval($totaldata),
                "candidate_id" => $candidate_id_ajax,
                "data" => $datas
            ];
           //dd($return);
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
      
        $data= ['page'=>$this->page,'user_type'=>$user_type,'status'=>$status,'candidate_id'=>$candidate_id];
       //dd($data);
        return view('admin.'.$this->page.'.documentListing',$data);

    }

    public function documentcreate(Request $request)
    {   
        $data = $request->all();
        $data['candidate_id'] = $request->candidate_id;
        
        $data= ['page'=>$this->page,'data'=>$data];        
        return view('admin.'.$this->page.'.documentcreate',$data);
    }


    public function documentstore(Request $request)
    { 
         //dd($request->all());
        $input = $request->all();
        
         //dd($input);
        //sent mail to payment user
        //$message = [];
        $validation = [
            'aadhar_card'          => 'required|max:190',
            'bank_account_number'         => 'required|max:190',
            'bank_name' => 'required',
            'bank_IFSC_code' => 'required',
            
        ]; 
        // $message = [
        //     'primary_mobile_number.digits' =>'The mobile number must be between 10 digits.',
            
        // ];
            
        $this->validate($request,$validation);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
          
            $data = new CandidateDocument;
            if ($request->file('image')) {
                $file = $request->file('image');
                $result = file_upload($file, 'user');
                     ///dd($result);
                if ($result[0] == true) {
                    $data->image = $result[1];
                }
            }

            if ($request->file('aadhar_card_image')) {
                $file1 = $request->file('aadhar_card_image'); 
                
                $aadhar = file_upload1($file1, 'adhar');
                     //dd($result);
                if ($aadhar[0] == true) {
                    $data->aadhar_card_image = $aadhar[1];
                }
            }

            if ($request->file('pan_card_image')) {
                $file2 = $request->file('pan_card_image'); 
                $pancard = file_upload2($file2, 'pancard');
                     //dd($result);
                if ($pancard[0] == true) {
                    $data->pan_card_image = $pancard[1];
                }
            }
            
            $data->candidate_id = $input['candidate_id'];
            $data->aadhar_card = $input['aadhar_card'];
            //$data->aadhar_card_image = $input['aadhar_card_image'];
            $data->pan_card = $input['pan_card'];
            //$data->pan_card_image = $input['pan_card_image'];
            $data->bank_account_number = $input['bank_account_number'];
            $data->bank_IFSC_code = $input['bank_IFSC_code'];
            $data->bank_name = $input['bank_name'];
            $data->status = 1;
            $data->user_type = 2;
            //$data->role = 'HRmanager';
            $data->save();
        
         return Redirect::route('admin.'.$this->page.'.documentListing',['candidate_id'=>$request->candidate_id])->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
            return customeRedirect('admin.'.$this->page.'.documentListing','','error',$e);                       
        }
    
    }

    public function documentshow(Request $request)
    {
        $id = $request->id;
        $data = $this->ModelsCandidateDocument->where('candidate_documents.id',$id)->first();
        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.documentshow',$data);
    }


    public function documentedit(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        $id = $request->id;
        $data = $this->ModelsCandidateDocument->find($id); 

        $data= ['page'=>$this->page,'data'=>$data];
        // dd($data);
        return view('admin.'.$this->page.'.documentedit',$data);
    }

     

    public function documentupdate(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        // validate
        //dd($request->all());
        $id = $request->id;
        
        $mesasge = [
            'aadhar_card.required' => __("backend.aadhar_card_required"),
            
           
            

        ];
        $this->validate($request, [
            'aadhar_card' => 'required|max:255',
        ], $mesasge);

        $input = $request->all();
      
        //dd($input);
        //$data->secondarySkills = $input['secondarySkills'];
        $fail = false;         
         
        if (!$fail) {
            $file = $request->file('image');
            //$file = $request->file('aadhar_card_image');
            //$file = $request->file('pan_card_image');
          
            try {
                if (isset($file)) {
                    $result = file_upload($file, 'user');                 
                    $data = CandidateDocument::where('id', $id)->update(['aadhar_card' => $input['aadhar_card'], 'pan_card' => $input['pan_card'],'bank_account_number' => $input['bank_account_number'],
                    'bank_IFSC_code' => $input['bank_IFSC_code'],'bank_name' => $input['bank_name'],'image' => $result[1],'aadhar_card_image' => $result[1],'pan_card_image' => $result[1]]);
                    
                } else {
                    $data = CandidateDocument::where('id', $id)->update(['aadhar_card' => $input['aadhar_card'], 'pan_card' => $input['pan_card'],'bank_account_number' => $input['bank_account_number'],
                    'bank_IFSC_code' => $input['bank_IFSC_code'],'bank_name' => $input['bank_name']]);
                }
                return Redirect::route('admin.candidate.documentListing')->with('success',"Record updated successfully.");
            } catch (Exception $e) {
                return Redirect::Back()->with('error',"Something went wrong.");
            }
        } else {
            return Redirect::Back()->with('error',"Something went wrong.");
        }
    }

    public function informationListing(request $request){
             

        $candidate_id = $request->id;
        //dd($candidate_id);
    
    if ($request->ajax()) { 
        
        $information_id_ajax = $request->input('candidate_id');
        //dd($information_id_ajax);
        $data = $this->ModelsCandidateInformation->where('candidate_information.candidate_id',$information_id_ajax)->get(); 
       //dd($data);
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request['search']['value'];
        $filter = $request['filter'] ?? null;
        $orderby = $request['order']['0']['column'];
        $order = $orderby != "" ? $request['order']['0']['dir'] : "";
        $draw = $request['draw'];
        $status = $request['status'] ?? null;
        $start_date = $request['start_date'] ?? null ;
        $min = $request['min'] ?? null ;
        $max = $request['max'] ?? null ;
        $end_date = $request['end_date'] ?? null; 
        $user_type = 2; 
        $sortableColumnsCandidateInformation = $this->sortableColumnsCandidateInformation;            
        $querydata = $this->ModelsCandidateInformation->getModel($search, $sortableColumnsCandidateInformation[$orderby], $order,$start_date,$end_date,$status,$user_type,$filter,$min,$max,$information_id_ajax);
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
            $row['school_university_name'] = isset($value->school_university_name)? $value->school_university_name:'N/A';
            $row['passout_year'] = isset($value->passout_year)? $value->passout_year:'N/A';
            $row['percentage'] = isset($value->percentage)? $value->percentage:'N/A';
            $row['created_at'] = date('d M Y', strtotime($value->created_at));
            $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();


            // if($value->status==1) {
            //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
            // }else{
            //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
            // }
           
           
            //$edit = editAction($this->page.'.informationedit',['id'=>$value->id]);
            $view = viewAction($this->page.'.informationshow',['id'=>$value->id]);
            //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
            //$document = documentAction($this->page.'.candidateDocumentInfo',['id'=>$value->id]);
            
            //$pdf = '<a href="'.$value->image.'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';
            
            // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
             
            $row['actions']=createAction($view);
            $datas[] = $row;
            $i++;
            unset($u);
        }
        $return = [
            "draw" => intval($draw),
            "recordsFiltered" => intval($totaldata),
            "recordsTotal" => intval($totaldata),
            "information_id" => $information_id_ajax,
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
  
    $data= ['page'=>$this->page,'user_type'=>$user_type,'status'=>$status,'candidate_id'=>$candidate_id];
   //dd($data);
    return view('admin.'.$this->page.'.informationListing',$data);

}


public function informationcreate(Request $request)
    {   
        $data = $request->all();
        $data['candidate_id'] = $request->candidate_id;
        //dd($data);
        $data= ['page'=>$this->page,'data'=>$data];        
        return view('admin.'.$this->page.'.informationcreate',$data);
    }


    public function informationstore(Request $request)
    { 
         //dd($request->all());
        $input = $request->all();
        
         //dd($input);
        //sent mail to payment user
        //$message = [];
        $validation = [
            'school_university_name'          => 'required',
            'passout_year'         => 'required',
            'percentage' => 'required',
           
            
        ]; 
        // $message = [
        //     'primary_mobile_number.digits' =>'The mobile number must be between 10 digits.',
            
        // ];
            
        $this->validate($request,$validation);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
          
            $data = new CandidateInformation;
            
            $data->candidate_id = $input['candidate_id'];
            //$data->candidate_id = $input['candidate_id'];
            $data->school_university_name = $input['school_university_name'];
            $data->passout_year = $input['passout_year'];
            $data->percentage = $input['percentage'];
            $data->status = 1;
            $data->user_type = 2;
            $data->save();
        
         return Redirect::route('admin.'.$this->page.'.informationListing')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
            return customeRedirect('admin.'.$this->page.'.informationListing','','error',$e);                       
        }
    
    }


    public function informationshow(Request $request)
    {
        $id = $request->id;
        $data = $this->ModelsCandidateInformation->where('candidate_information.id',$id)->first();
        //dd($data);
        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.informationshow',$data);
    }







    // public function candidateDocumentInfo(){
        
    //     return view('admin.'.$this->page.'.documentInfo');
    // }

    // public function status(Request $request)
    // {
    //     $id = $request->id;
    //     try {
    //         $data = $this->Models->findOrFail($id);
    //         $data->status = $request->value;
    //         $data->save();
    //         return ['status'=>1,'type'=>'success','message'=>'Status update Successfully.'];
    //     } catch (ModelNotFoundException $e) {
    //         return ['status'=>0,'type'=>'danger','message'=>'Something went wrong.'];
    //     }
    // }

    // public function changeStatus($id, $status)
    // {
    //     $details = User::find($id);
    //     if (!empty($details)) {
    //         if ($status == 'active') {
    //             $inp = ['status' => 1];
    //         } else {
    //             $inp = ['status' => 0];
    //         }
    //         $User = User::findOrFail($id);
    //         if ($User->update($inp)) {
    //             if ($status == 'active') {
    //                 $result['message'] = __("backend.Facility_Owner_status_success");
    //                 $result['status'] = 1;
    //             } else {
    //                 $result['message'] = __("backend.Facility_Owner_status_deactivate");
    //                 $result['status'] = 1;
    //             }
    //         } else {
    //             $result['message'] = __("backend.Facility_Owner_status_can`t_updated");
    //             $result['status'] = 0;
    //         }
    //     } else {
    //         $result['message'] = __("backend.Invaild_user");
    //         $result['status'] = 0;
    //     }
    //     return response()->json($result);
    // }
}
