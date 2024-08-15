<?php

namespace App\Http\Controllers;
use App\Models\Enquiry;
use App\Models\Archive;
use App\Models\Language;
use App\Models\Secondarylanguages;
use App\Models\Candidate;
use App\Models\EmployeeProject;
use App\Models\Invoice;
use App\Models\Contact;
use App\Models\PrimaryCountries;
use App\Models\SecondaryCountries;
use App\Models\User;
use App\Models\Project;
use App\Models\CurrentEmployee;
use App\Models\Client;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;
use File,DB;
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


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'clients';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Client(); 
        $this->sortableColumns = [
            0 => 'client_name',
            1 => 'email',
            2 => 'client_mobile_number',
            3 => 'client_GST_number',
            4 => 'primary_country',
            5 => 'client_address',
            6 => 'status',
            
        ];
    }

    public function index(request $request)
    { 
           
        
        if ($request->ajax()) {    
            //$client_id_ajax = $request->input('primary_country_id');
            //dd($client_id_ajax);
            //$data = $this->Models->where('clients.primary_country_id',$client_id_ajax)->get();  

            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 5; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$status,$start_date,$end_date,$user_type, $request);
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
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['client_mobile_number'] = isset($value->client_mobile_number)? $value->client_mobile_number:'N/A';
                $row['client_GST_number'] = isset($value->client_GST_number)? $value->client_GST_number:'N/A';
                $row['primary_country'] = isset($value->primary_country)? $value->primary_country:'N/A';
                $row['client_address'] = isset($value->client_address)? $value->client_address:'N/A';
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();
                $row['role'] = isset($value->role)? $value->role:'N/A';
                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
                $edit = editAction($this->page.'.edit',['id'=>$value->id]);
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                
                $row['actions']=createAction($edit.$delete);
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



    public function filterProfile()
    {
        $countries = Country::get();

        $profiles = Profile::with('user')->where('country_id', '=' , $countries)->latest()->get();

        return View::make('users.search',compact('countries'))->withProfiles($profiles)->with('title', 'filter');
    }



    public function frontend()
    {
        
        $client = Client::where('user_type', '5')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.clients.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['client'] = Client::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $id = $request->id;
        $data['primary_country'] = Client::all();
        $data['button'] = 'Save';
        $data= ['page'=>$this->page,'data'=>$data , 'data' => $data];        
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
        $input = $request->all();
        //sent mail to payment user
        $validation = [
            'client_name'          => 'required|max:190',
            'email'         => 'required|email|unique:clients|unique:users|max:50|regex:/(.+)@(.+)\.(.+)/i',
            'client_mobile_number' => 'required|unique:clients|numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/',
        ]; 
        $message = [
            
        ];
            
        $this->validate($request,$validation,$message);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
            $data = new Client;
            
            $data->client_name = $input['client_name'];
            $data->email = $input['email'];

            $data->client_mobile_number = $input['client_mobile_number'];

            $data->client_GST_number = $input['client_GST_number'];

            $data->primary_country = $input['primary_country'];
            $data->client_address = $input['client_address'];
            $data->status = 1;
            $data->user_type = 5;
            $data->role = 'client';
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
        // validate
        $input = $request->all();
        $mesasge = [
            'client_name.required' => "Name field is required.",
            'email_address.required' => "Email field is required.",
            'email.email' => "Please enter valid email.",
            'email.unique' => "Email is already taken.",
            // 'mobile.required' => "Mobile number field is required.",
            // 'mobile.digits_between' => "Mobile number must be in between 7 to 15 digits only.",
            // 'image.size'  =>  "Image is too large.",
        ];
        $this->validate($request, [
            'client_name' => 'required|max:255',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:clients|unique:users,email',

        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new Client;
                // if ($request->file('image')) {
                //     $file = $request->file('image');
                //     $result = image_upload($file, 'user');
                //     if ($result[0] == true) {
                //         // dd($result);
                //         $data->image = $result[1];
                //     }
                // }
                $data->client_name = $input['client_name'];
                $data->email = $input['email'];
                $data->client_mobile_number = $input['client_mobile_number'];

                $data->client_GST_number = $input['client_GST_number'];

                
                $data->primary_country = $input['primary_country'];
                $data->client_address = $input['client_address'];
                $data->status = 1;
                $data->user_type = 5;
                $data->role = 'client';
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
    // public function show(Request $request)
    // {
    //     $id = $request->id;
    //     $data = $this->Models->where('clients.id',$id)->first();
    //     // dd($data);
    //     $data= ['page'=>$this->page,'data'=>$data];
    //     return view('admin.'.$this->page.'.show',$data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {

        $id = $request->id;
        $data = $this->Models->find($id);
        //$data['primary_country'] = PrimaryCountries::all();

        $data['button'] = 'Update';
        $data= ['page'=>$this->page,'data'=>$data , 'data' => $data];
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
        $message = [
            'mobile.digits_between' =>'The mobile number must be between 7 to 14 digits.',
        ];       

        $validation = [
            'client_name'     => 'required|max:190',
            'email' => 'required|max:190|email|unique:users|unique:clients,email, '. $data->id . ',id',
            // 'client_GST_number' => 'required|max:190|GST|unique:users|unique:clients,client_GST_number, '. $data->id . ',id',
            'client_mobile_number' => 'required|numeric|regex:/^([+0-9][0-9\s\-\(\)]*)$/|unique:users,client_mobile_number, '. $data->id . ',id',
            'client_mobile_number.required' => "Mobile number field is required.",
            'client_mobile_number.digits' => "Mobile number must be in between 10 digits only.",
        ];  
        // dd($input, $data);     


        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.clients.index')->with('success',"Record updated successfully.");

        } catch (Exception $e) {
            return Redirect::Back()->with('error',__('backend.something_went_wrong'));
        }
    }
    public function update(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        // validate
        $id = $request->id;
        $mesasge = [
            'client_name.required' => __("backend.name_required"),
            'email.required' => __("backend.email_required"),
            'email.email' => __("backend.email_email"),
            'email.unique' => __("email already taken"),
            // 'client_GST_number.unique' => __("client_GST_number already taken"),
            'client_mobile_number.required' => __("backend.mobile_required"),
            
            //  'mobile.required' => __("backend.mobile_required"),
            //  'mobile.digits_between' => __("backend.mobile_digits_between"),
            //  'image.size'  =>  __("backend.image_size"),

        ];
        $this->validate($request, [
            'client_name' => 'required|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            // 'client_GST_number' => 'required|GST|unique:clients,client_GST_number,' . $id,
            'client_mobile_number' => 'required|numeric|unique:clients,client_mobile_number,' .$id,

        ], $mesasge);

        $input = $request->all();
        $fail = false;

        if (!$fail) {                                                                                            
                                                                                                                                                                            
                                                                                                                                                                           
            $file = $request->file('image');
            try {
                if (isset($file)) {
                    $result = image_upload($file, 'user');                 
                    $data = Client::where('id', $id)->update(['client_name' => $input['client_name'], 'email' => $input['email'],'client_mobile_number' => $input['client_mobile_number'],  'client_GST_number' => $input['client_GST_number'],  'primary_country' => $input['primary_country'],'client_address' => $input['client_address']]);
                } else {
                    $data = Client::where('id', $id)->update(['client_name' => $input['client_name'], 'email' => $input['email'],'client_mobile_number' => $input['client_mobile_number'],  'client_GST_number' => $input['client_GST_number'],  'primary_country' => $input['primary_country'],'client_address' => $input['client_address']]);
                }
                return Redirect::route('admin.clients.index')->with('success',"Record updated successfully.");
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
        $data =  Client::findOrFail($id)->delete();
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
        $details = Client::find($id);
        if (!empty($details)) {
            if ($status == 'active') {
                $inp = ['status' => 1];
            } else {
                $inp = ['status' => 0];
            }
            $User = Client::findOrFail($id);
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
