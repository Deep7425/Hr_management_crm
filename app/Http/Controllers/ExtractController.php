<?php

namespace App\Http\Controllers;
use App\Models\Extract;
use App\Models\Language;
use App\Models\Link;
use App\Models\Secondarylanguages;
use App\Models\Candidate;
use App\Models\User;
use App\Models\CurrentEmployee;
use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Contact;
use App\Models\PrimaryCountries;
use App\Models\SecondaryCountries;
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


class ExtractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'extracts';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Extract(); 
        $this->sortableColumns = [
            0 => 'name',
            1 => 'email',
            2 => 'alternate_email',
            3 => 'mobile_number',
            4 => 'primary_country',
            5 => 'country_location',
            6 => 'created_at',
            7 => 'requirements',
            8 => 'linkedIn_url',
            9 => 'up_url',
            10 => 'image',
            11 => 'secondary_country',
            12 => 'status',
            13 => 'project_title',
            14=> 'bark_url',
            15 => 'lead_source',
            16 => 'whatsapp_url',
            
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
            $user_type = 7; 
            $sortableColumns = $this->sortableColumns;   
            // dd($status);         
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
                $row['lead_source'] = isset($value->lead_source)? $value->lead_source:'N/A';
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['alternate_email'] = isset($value->alternate_email)? $value->alternate_email:'N/A';
                $row['mobile_number'] = isset($value->mobile_number)? $value->mobile_number:'N/A';
                $row['primary_country'] = isset($value->primary_country)? $value->primary_country:'N/A';
                $row['secondary_country'] = isset($value->secondary_country)? $value->secondary_country:'N/A';
                $row['country_location'] = isset($value->country_location)? $value->country_location:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['whatsapp_url'] = isset($value->whatsapp_url)? $value->whatsapp_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();
                //$row['status'] = statusAction($value->status, $value->id,['0'=>'Ajay Sir','1'=>'Extract'],'statusAction',$this->page.'.status')->toHtml();
              
               
                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                //$edit = editAction($this->page.'.edit',['id'=>$value->id]);
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                 
                if($value->linkedIn_url){
                $linkdin = '<a href="'.$value->linkedIn_url.'" data-id="'.$value->id.'" target="_blank" class="" ><i class="fa fa-linkedin"></i></a>';
                }else{
                    $linkdin =''; 
                }
                if($value->up_url){
                $upUrl = '<a href="'.$value->up_url.'" data-id="'.$value->id.'" target="_blank" class="" ><i class="fa fa-link  mr-1"></i></a>';
                }else{
                $upUrl ='';
                }
                if($value->bark_url){
                $barkUrl = '<a href="'.$value->bark_url.'" data-id="'.$value->id.'" target="_blank" class="" ><i class="fa fa-bars  mr-1"></i></a>';
                }else{
                    $barkUrl ='';  
                }
                if($value->whatsapp_url == 'yes'){
                $whatsapp = '<a href="https://wa.me/'.$value->mobile_number.'" data-id="'.$value->id.'" target="_blank" class="" ><i class="fa fa-whatsapp  mr-1"></i></a>';
                }else{
                $whatsapp  = '';
                }
                //$delete = '<a href="'.$value->linkedIn_url.'" class="delete_content" data-id="'.$value->id.'"><i class="fas fa fa-trash  mr-1"></i></a>';
                // $login_user_data = auth()->user();
                // if($login_user_data->user_type == 1) {
                // $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                // }else{
                //     $delete ='';   
                // }
                //$pdf = '<a href="'.$value->image.'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                
                $row['extraLink']=linkAction($linkdin.$upUrl.$barkUrl.$whatsapp);
                
                $row['actions']=createAction($view);
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
        
       
        $data = Contact::where('status','extract')->get();
        //dd($data);
        $data= ['page'=>$this->page,'user_type'=>$user_type,'status'=>$status,'data'=>$data];
       
        return view('admin.'.$this->page.'.listing',$data);
    }


    public function frontend()
    {
        $contacts = Contact::where('user_type',7)->get();
        
        $data= ['page'=>$this->page]; 
        return view('admin.extracts.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['contact'] = Contact::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['lead_source']= Contact::all();
        $data['secondary_country'] = SecondaryCountries::all();
        $data= ['page'=>$this->page,'page_type'=>'add','data'=>$data];        
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
            'project_title'          => 'required',
            'name'          => 'required|max:190',
            'primary_country'          => 'required|max:190',
            'email'         => 'required|email|unique:users|unique:contacts|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            
            //'mobile_number.digits' =>'The mobile number must be between 15 digits.',
            
        ]; 
        $message = [
            'alternate_email'         => 'alternate_email|unique:contacts|max:50|regex:/(.+)@(.+)\.(.+)/i',
            'primary_country'          => 'required|max:190',
            //'mobile_number.digits' =>'The mobile number must be between 15 digits.',
            
        ];
            
        $this->validate($request,$validation,$message);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
            $login_user_data = auth()->user();
            $data = new Contact;
            if ($request->file('image')) {
                $file = $request->file('image');
                $result = file_upload($file, 'user');
                     //dd($result);
                if ($result[0] == true) {
                    $data->image = $result[1];
                }
            }
            
            $data->project_title = $input['project_title'];
            if($login_user_data->user_type == 1) {
                $data->lead_source = $input['lead_source'];
            }
            $data->name = $input['name'];
            $data->email = $input['email'];
            $data->alternate_email = $input['alternate_email'];
            $data->mobile_number = $input['mobile_number'];
            $data->primary_country = $input['primary_country'];
            
            if (isset($input['secondary_country']) && $input['secondary_country']) {
                $data->secondary_country = implode(',',$input['secondary_country']);

            } else {
                $data->secondary_country = '';
            }

            if (isset($input['country_location']) && $input['country_location']) {
                $data->country_location = $input['primary_country'].','.implode(',',$input['secondary_country']);

            }else if(isset($input['country_location']) && $input['country_location'] || isset($input['secondary_country']) && $input['secondary_country']){
                $data->country_location = $input['primary_country'].','.implode(',',$input['secondary_country']);
            } else{
                $data->country_location = $input['primary_country'];

            }

            //$data->country_location = $input['primary_country'].','.implode(',',$input['secondary_country']);
            $data->requirements = $input['requirements'];
            $data->linkedIn_url = $input['linkedIn_url'];
            $data->up_url = $input['up_url'];
            $data->bark_url = $input['bark_url'];
            $data->whatsapp_url = $input['whatsapp_url'];
            if($login_user_data->user_type == 1) {
            $data->status = $input['lead_source'];
            }else{
                $data->status ='ajaysir';

            }
            $data->user_type = 7;
            $data->role = 'Contactmanager';
            if($data->save()){
                if(isset($input['secondary_country'])){
                    foreach($input['secondary_country'] as $skills){
                        $check_skill = SecondaryCountries::where('secondary_country',$skills)->first();
                        if($check_skill == null){
                            $secLanguage = new SecondaryCountries;
                            $secLanguage->secondary_country = $skills;
                            // $language->secondary_country = implode(',',$input['secondary_country']);
                            $secLanguage->save();
                        }
                        // dd($check_skill);
                    }
                }
                //dd($data); 
            }
            //dd($data);
            

            

         return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
            return customeRedirect('admin.'.$this->page.'.index','','error',$e);                       
        }
    }
    

    public function checkEmail(Request $request){
        // dd($request->all());
        if($request->ajax()){
        if(Contact::where('email','=',$request->input('email'))->exists()){
            return response()->json(['success' => true, 'email_cls' => 'email address already exists']);
         }else{                                                                    
            return response()->json(['success' => false, 'email_cls' => '']);
         }
        }
    }

    public function checkPhone(Request $request){
        // dd($request->all());
        if($request->ajax()){
        if(Contact::where('mobile_number','=',$request->input('mobile_number'))->exists()){
            return response()->json(['success' => true, 'phone_cls' => 'Phone number already exists']);
         }else{                                                                    
            return response()->json(['success' => false, 'phone_cls' => '']);
         }
        }
    }

    public function store_old(Request $request)
    {
        // Gate::authorize('subadmin-create');
        // validate
        $input = $request->all();
        $mesasge = [
            'project_title.required' => "Project Title field is required.",
            'name.required' => "Name field is required.",
            'email.required' => "Email field is required.",
            'email.email' => "Please enter valid email.",
            'email.unique' => "Email is already taken.",
             'mobile_number.max' => "Mobile number must be in 15 digits only.",
             'primary_country'  =>  "Country field is required",
        ];
        $this->validate($request, [
            //'name' => 'required|max:255',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            //'email' => 'required|email|unique:contacts,email',
            //'mobile_number' => 'required|max:15|unique:contacts,mobile_number',
            

        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new Contact;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $result = file_upload($file, 'user');
                    if ($result[0] == true) {
                        // dd($result);
                        $data->image = $result[1];
                    }
                }
                $data->project_title = $input['project_title'];
                $data->lead_source = $input['lead_source'];
                $data->name = $input['name'];
            $data->email = $input['email'];
            $data->alternate_email = $input['alternate_email'];
            $data->mobile_number = $input['mobile_number'];
            $data->primary_country = $input['primary_country'];
            
            $data->secondary_country = $input['secondary_country'];
            
            $data->requirements = $input['requirements'];
            $data->linkedIn_url = $input['linkedIn_url'];
            $data->up_url = $input['up_url'];
            $data->whatsapp_url = $input['whatsapp_url'];
            $data->status = $input['lead_source'];
            $data->user_type = 7;
            $data->role = 'Contactmanager';
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
        $data = $this->Models->where('contacts.id',$id)->first();
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
       
        // $data['lead_source']= Contact::all();
        
       
        //$data['selected_primary_country'] = explode(',',$data->primary_country);
      
        $data['selected_secondary_country'] = explode(',',$data->secondary_country);

         //$data['primary_country'] = PrimaryCountries::all();
         $data['secondary_country'] = Secondarycountries::all();
        
         
         
 
        $data= ['page'=>$this->page,'page_type'=>'edit','data'=>$data];
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
            'project_title'     => 'required',
            'name'     => 'required|max:190',
            'email' => 'required|max:190|email|unique:contacts,email, '. $data->id . ',id',
            'mobile_number.digits' => "Mobile number must be in between 10 digits only.",
            
        ];  
        // dd($input, $data);     
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
           
            //dd($$input['primarySkills']);
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.contacts.index')->with('success',"Record updated successfully.");

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
            
            'project_title.required' => __("backend.project_title_required"),
            'name.required' => __("backend.name_required"),
            'email.required' => __("backend.email_required"),
            'email.email' => __("backend.email_email"),
            'email.unique' => __("The email has already been taken."),
            

        ];
        $this->validate($request, [
            'project_title' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts,email,' . $id,
            
            
        ], $mesasge);

        $input = $request->all();
      
        // dd($input);
        //$data->secondarySkills = $input['secondarySkills'];
        $fail = false;         
         
        if (!$fail) {
            $file = $request->file('image');
          
            try {
                if (isset($file)) {
                    if (isset($input['secondary_country']) && !empty($input['secondary_country'])) {
                        $secondary_country = implode(',',$input['secondary_country']);
                    } else {
                        $secondary_country = '';
                    }
                    if (isset($input['country_location']) && $input['country_location']) {
                        $country_location = $input['primary_country'].','.implode(',',$input['secondary_country']);
        
                    }else if(isset($input['country_location']) && $input['country_location'] || isset($input['secondary_country']) && $input['secondary_country']){
                        $country_location = $input['primary_country'].','.implode(',',$input['secondary_country']);
                    } else{
                        $country_location = $input['primary_country'];
        
                    }
                    $result = file_upload($file, 'user');
                    $data = Contact::where('id', $id)->update(['project_title' => $input['project_title'],'lead_source' => $input['lead_source'],'name' => $input['name'], 'email' => $input['email'],'alternate_email' => $input['alternate_email'],'mobile_number' => $input['mobile_number'],'primary_country' => $input['primary_country'],'secondary_country' => $secondary_country,'country_location' => $country_location,'requirements' => $input['requirements'],'linkedIn_url' => $input['linkedIn_url'],'up_url' => $input['up_url'],'bark_url' => $input['bark_url'],'whatsapp_url' => $input['whatsapp_url'],'created_at' => $input['created_at'],'image' => $result[1]]);         
                    
                } else {
                    //  dd('else');
                    // dd($input['secondary_country']);
                    if (isset($input['secondary_country']) && !empty($input['secondary_country'])) {
                        $data = Contact::where('id', $id)->update(['project_title' => $input['project_title'],'lead_source' => $input['lead_source'],'name' => $input['name'], 'email' => $input['email'],'alternate_email' => $input['alternate_email'],'mobile_number' => $input['mobile_number'],'primary_country' => $input['primary_country'],'secondary_country' => implode(',',$input['secondary_country']),'country_location' => $input['primary_country'].','.implode(',',$input['secondary_country']),'requirements' => $input['requirements'],'linkedIn_url' => $input['linkedIn_url'],'up_url' => $input['up_url'],'bark_url' => $input['bark_url'],'whatsapp_url' => $input['whatsapp_url'],'created_at' => $input['created_at'],]);
                         
                    } else {
                        $data = Contact::where('id', $id)->update(['project_title' => $input['project_title'],'lead_source' => $input['lead_source'],'name' => $input['name'], 'email' => $input['email'],'alternate_email' => $input['alternate_email'],'mobile_number' => $input['mobile_number'],'primary_country' => $input['primary_country'],'secondary_country' => '','country_location' => $input['primary_country'],'requirements' => $input['requirements'],'linkedIn_url' => $input['linkedIn_url'],'up_url' => $input['up_url'],'bark_url' => $input['bark_url'],'whatsapp_url' => $input['whatsapp_url'],'created_at' => $input['created_at']]);
                    }
                    
                }
                return Redirect::route('admin.contacts.index')->with('success',"Record updated successfully.");
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
        $data =  Contact::findOrFail($id)->delete();
        $data= ['page'=>$this->page,'data'=>$data];
        // dd($data);
        //Gate::authorize('subadmin-delete');
        
        return view('admin.'.$this->page.'.listing',$data);
       
    }
     
    public function delete(Request $request)
    {   
        //dd($request->all());
        $id = $request->id;
        $Content = Contact::findOrFail($id)->delete();
        return response()->json(['success'=>"Contact Deleted successfully."]);
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
        $details = Contact::find($id);
        if (!empty($details)) {
            if ($status == 'extract') {
                $inp = ['status' => 1];
            } else {
                $inp = ['status' => 0];
            }
            $User = Contact::findOrFail($id);
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
