<?php

namespace App\Http\Controllers;
use App\Models\User;
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


class HiringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'hiringadmin';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new User(); 
        $this->sortableColumns = [
            0 => 'name',
            1 => 'email',
            2 => 'password',
            3 => 'status',
            4 => 'created_at',
        ];
    }

    public function index(request $request)
    { 
        
        if ($request->ajax()) {            
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
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
                $row['name'] = isset($value->name)? $value->name:'N/A';
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
            
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();

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
    
        $user = User::where('user_type', '3')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.hiringadmin.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['user'] = User::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        $data= ['page'=>$this->page];        
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
        // dd($input);
        //sent mail to payment user
        //$message = [];
        $validation = [
            'name'          => 'required|max:190',
            'email'         => 'required|email|unique:users|max:50|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|min:6|max:20', 
        ]; 
        // $message = [
        //     'mobile.digits_between' =>'The mobile number must be between 8 to 15 digits.',
        // ];
            
        $this->validate($request,$validation);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
            $data = new User;

            $data->name = $input['name'];
            $data->email = $input['email'];
            $data->password = Hash::make($input['password']);
            $data->status = 1;
            $data->user_type = 3;
            $data->role = 'hiringmanager';
            $data->save();
            // dd($data);
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
            'name.required' => "Name field is required.",
            'email.required' => "Email field is required.",
            'email.email' => "Please enter valid email.",
            'email.unique' => "Email is already taken."
            // 'mobile.required' => "Mobile number field is required.",
            // 'mobile.digits_between' => "Mobile number must be in between 7 to 15 digits only.",
            // 'image.size'  =>  "Image is too large.",
        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password' => 'required|min:7,12|unique:users,password',

        ], $mesasge);

        $fail = false;
        if (!$fail) {
            try {

                $data = new User;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $result = image_upload($file, 'user');
                    if ($result[0] == true) {
                        // dd($result);
                        $data->image = $result[1];
                    }
                }
                $data->name = $input['name'];
                $data->email = $input['email'];
                $data->password = $input['password'];
                $data->status = 1;
                $data->type = 1;
                $data->role = 'User';
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
        $data = $this->Models->where('users.id',$id)->first();
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

        $id = $request->id;
        $data = $this->Models->find($id);       
        $data= ['page'=>$this->page,'data'=>$data];
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
            'email' => 'required|max:190|email|unique:users,email, '. $data->id . ',id'
            //'password'  => 'required'
            //'mobile_number'=>'required|numeric|digits_between:8,15|regex:/^([1-9][0-9\s\-\+\(\)]*)$/|unique:users,mobile_number, '. $data->id . ',id,country_code,'.str_replace('+','',$input['country_code']),
        ];  
        // dd($input, $data);     
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.hiringadmin.index')->with('success',"Record updated successfully.");

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
            'name.required' => __("backend.name_required"),
            'email.required' => __("backend.email_required"),
            'email.email' => __("backend.email_email"),
            'email.unique' => __("backend.email_unique")
            //'password.required' => __("backend.password_code_required"
            // 'mobile.required' => __("backend.mobile_required"),
            // 'mobile.digits_between' => __("backend.mobile_digits_between"),
            // 'image.size'  =>  __("backend.image_size"),

        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:users,email,' . $id
            //'password' => 'required|min:6|max:20',

        ], $mesasge);

        $input = $request->all();
        $fail = false;

        if (!$fail) {
            $file = $request->file('image');
            try {
                if (isset($file)) {
                    $result = image_upload($file, 'user');                 
                    $data = User::where('id', $id)->update(['name' => $input['name'], 'email' => $input['email'], 'password' => Hash::make($input['password'])]);
                } else {
                    $data = User::where('id', $id)->update(['name' => $input['name'], 'email' => $input['email'], 'password' => Hash::make($input['password'])]);
                }
                return Redirect::route('admin.hiringadmin.index')->with('success',"Record updated successfully.");
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
        $data =  User::findOrFail($id)->delete();
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
        $details = User::find($id);
        if (!empty($details)) {
            if ($status == 'active') {
                $inp = ['status' => 1];
            } else {
                $inp = ['status' => 0];
            }
            $User = User::findOrFail($id);
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
