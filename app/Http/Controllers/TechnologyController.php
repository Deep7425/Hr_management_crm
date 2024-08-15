<?php

namespace App\Http\Controllers;
use App\Models\Technology;
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
use App\Models\PasswordReset as ModelsPasswordReset;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'technology';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Technology(); 
        $this->sortableColumns = [
        
            0 => 'technology_name',
            1 => 'created_at'
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
            $user_type = 2; 
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
                $row['technology_name'] = isset($value->technology_name)? $value->technology_name:'N/A';
           

                // ========================================================================================
                $row['created_at'] = date('d M Y', strtotime($value->created_at));
                $row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();               
                $edit = editAction($this->page.'.edit',['id'=>$value->id]);
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
              
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
       
        return view('admin.'.$this->page.'.listing',$data);
    }


    public function frontend()
    {
        // Gate::authorize('subadmin-section');
        $user = User::where('user_type', '2')->get();
        //$roles = Role::all();
        $data= ['page'=>$this->page]; 
        return view('admin.hradmin.listing', $data);
        
    }

    public function edit_frontend($id)
    {
        //Gate::authorize('subadmin-edit');
        //$data['roles']=Role::all();
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

        $data['button'] = 'Save'; 
        $data= ['page'=>$this->page ,'data' => $data]; 
           
        return view('admin.'.$this->page.'.create',$data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // { 


    //    /* {mData: 'beneficiary_name'},
    //     {mData: 'gst'},
    //     {mData: 'technology_name'},
    //     {mData: 'technology_accout_number'},
    //     {mData: 'ifsc'},
    //     {mData: 'swift_code'},
    //     {mData: 'branch'},
    //     {mData: 'created_at'},
    //     {mData: 'actions'}*/



    //     $input = $request->all();
    //      //dd($input);
    //     //sent mail to payment user
    //     $message = [];
    //     $validation = [
           
    //         'technology_name'  => 'required|max:255'

    //     ]; 
    
    //     $this->validate($request,$validation);       
    //     try{
    //         // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
    //         $this->Models->create($input);
    //         // dd($data);
    //         return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
    //     } catch (Exception $e) {
    //         //dd($e);
    //         return customeRedirect('admin.'.$this->page.'.index','','error',$e);                       
    //     }
    // }



    public function store(Request $request)
    { 



       /* {mData: 'beneficiary_name'},
        {mData: 'gst'},
        {mData: 'department_name'},
        {mData: 'department_accout_number'},
        {mData: 'ifsc'},
        {mData: 'swift_code'},
        {mData: 'branch'},
        {mData: 'created_at'},
        {mData: 'actions'}*/



        $input = $request->all();
        //  dd($input);
        //sent mail to payment user
        $message = [];
        $validation = [
           
            'technology_name'          => 'required|max:255'

        ]; 
    


        $this->validate($request,$validation,$message);    

        try{

            $data = new Technology;
            $data->technology_name = $input['technology_name'];
            $data->save();

            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
            // $this->Models->create($input);
            // dd($data);
            return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
            return customeRedirect('admin.'.$this->page.'.index','','error',$e);                       
        }
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
        $data = $this->Models->where('technology.id',$id)->first();
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
        $data['button'] = 'Update';    
        $data= ['page'=>$this->page,'data'=>$data ,'data'=>$data];
        
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
           
        $validation = [
          
            'technology_name'  => 'required|max:255'
           
        ];  
      
        $this->validate($request,$validation, $message);

        try{
            $user = $this->Models->where('id',$input['id'])->first();
            //$input['country_code']=str_replace('+','',$input['country_code']);
            unset($input['_token']);
            $data->update($input);
            return Redirect::route('admin.'.$this->page.'.index')->with('success',"Record updated successfully.");

        } catch (Exception $e) {
            return Redirect::Back()->with('error',__('backend.something_went_wrong'));
        }
    }
    public function update(Request $request)
    {
        // Gate::authorize('subadmin-edit');
        // validate
        $id = $request->id;
     
        $this->validate($request, [
            
            'technology_name'          => 'required|max:255'
            

        
        ]);

        $input = $request->all();
        
        $fail = false;

        if (!$fail) {
            $file = $request->file('image');
            try {
         
                  unset($input['_token']);
      
                $this->Models->where('id',$input['id'])->update($input);
                return Redirect::route('admin.'.$this->page.'.index')->with('success',"Record updated successfully.");
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
        //$data = $this->Models->find($id);       
        //$country = $this->Models_sev->orderBy('phonecode','asc')->get();
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

