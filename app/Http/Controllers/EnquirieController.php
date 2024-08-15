<?php

namespace App\Http\Controllers;
use App\Models\Enquiry;
use App\Models\Archive;
use App\Models\Language;
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


class EnquirieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'enquiry';
    protected  $table;

    public function __construct() {
        //$this->middleware('auth');
        $this->middleware('auth:', ['except' => ['index']]);
        $this->Models = new Enquiry(); 
        $this->sortableColumns = [

            0 => 'name',
            1 => 'email',
            2 => 'telephone',
            3 => 'ipaddress',
            4 => 'activity_path',
            5 => 'country',
            10 => 'region',
            7 => 'city',
            8 => 'url',
            9 => 'message',
            6 => 'created_at',
            
            
            
        ];

        $this->ModelsArchive = new Contact(); 
        $this->sortableColumnsArchive = [

            0 => 'name',
            1 => 'email',
            2 => 'telephone',
            3 => 'ipaddress',
            4 => 'activity_path',
            5 => 'country',
            10 => 'region',
            7 => 'city',
            8 => 'url',
            9 => 'message',
            6 => 'created_at',

            
        ];
        
    }

    public function index(request $request)
    { 


        if ($request->ajax()) {   
            $message =   $request['message'] ?? null; 
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
           
            $orderby = $request['order']['0']['column'];
            
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
           
            $draw = $request['draw'];
            //$status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            
            $sort_name = $request['sort_name'] ?? null ;
            $sort_type = $request['sort_type'] ?? null ;
            $sortableColumns = $this->sortableColumns;
              
            $type = $request['type'] ?? null;
            $live_enquire_ids = Contact::where('live_enquire_id','!=', Null)->pluck('live_enquire_id')->toArray();      
            //dd($live_enquire_ids); 
            if(isset($live_enquire_ids)){
                $newIds = implode(',', $live_enquire_ids);
            }
           
            
            $curl = curl_init();
//            dd($limit,$start);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.inventcolabssoftware.com/createApi',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('limit' => $limit,'sort_name' => $sort_name,'sort_type' => $sort_type,'search' => $search,'offset' => $start,'orderby'=>$orderby,'type'=>'index','live_enquire_ids'=>$newIds)
            ));
        
    //dd(array('limit' => $limit,'sort_name' => $sort_name,'sort_type' => $sort_type,'search' => $search,'offset' => $start,'orderby'=>$orderby,'type'=>'index','live_enquire_ids'=>$live_enquire_ids));
            $response = curl_exec($curl);
             //dd($curl);
            curl_close($curl);
            
            $response1 = json_decode($response);           
            //dd($response1);
             //$total_data = !empty($response1->total_data) ? $response1->total_data : null;
             //$response = !empty($response1->data) ? $response1->data : null;

             $total_data = $response1->total_data ?? 0 ;
             $response =   $response1->data ?? [];

             $datas = array();
                                     
             if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }
            
      
            $i = 1;
            foreach ($data as $value) {
                
                $row['id'] = $i;
                $row['name'] = isset($value->name)? $value->name:'N/A';
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['telephone'] = isset($value->telephone)? $value->telephone:'N/A';
                $row['ipaddress'] = isset($value->ipaddress)? $value->ipaddress:'N/A';
                $row['activity_path'] = isset($value->activity_path)? $value->activity_path:'N/A';
                $row['country'] = isset($value->country)? $value->country:'N/A';
                $row['region'] = isset($value->region)? $value->region:'N/A';
                $row['city'] = isset($value->city)? $value->city:'N/A';
                $row['url'] = isset($value->url)? $value->url:'N/A';
                $row['message'] = isset($value->message)? $value->message:'N/A';
                $row['created_at'] = date('Y-m-d H:i:s', strtotime($value->created_at));

                $row['type'] = typeAction($type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified',
                'business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold',
                'lost_lead'=>'Lost'])->toHtml();
                

                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $move = '<a href="javascript:void(0)" class="move_archive" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                
                $row['actions']=createAction($view.$move);
                $datas[] = $row;
                $i++;
                //unset($u);
                
            }
           
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($total_data),
                "recordsTotal" => intval($total_data),
                'data'=> $datas

            ];
         //dd($return);
             
            return $return;
            
        }
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listing',$data);
    }
    

    public function archiveIndex(request $request){
       
        if ($request->ajax()) {   
            $message =   $request['message'] ?? null; 
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            //$status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sort_name = $request['sort_name'] ?? null ;
            $sort_type = $request['sort_type'] ?? null ;
            $sortableColumns = $this->sortableColumns;
            $type = $request['type'] ?? null;
            $live_enquire_ids = Archive::where('live_enquire_id','!=', Null)->pluck('live_enquire_id')->toArray();
            $newIds = implode(',', $live_enquire_ids);
            
            $curl = curl_init();
//            dd($limit,$start);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.inventcolabssoftware.com/createApi',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('limit' => $limit,'sort_name' => $sort_name,'sort_type' => $sort_type,'search' => $search,'offset' => $start,'orderby'=>$orderby,'type'=>'archive','live_enquire_ids'=>$newIds)),
            );
        
             //dd(array('limit' => $limit,'sort_name' => $sort_name,'sort_type' => $sort_type,'search' => $search,'offset' => $start,'orderby'=>$orderby,'type'=>'index','live_enquire_ids'=>$live_enquire_ids));
            $response = curl_exec($curl);
             
            curl_close($curl);
            
            $response1 = json_decode($response);
            //dd($response1);
       
            $total = $response1->total_data;
            $response = $response1->data;
            
            
             $datas = array();
                                     
             if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }
            
      
            $i = 1;
            foreach ($data as $value) {
                 
                $row['id'] = $i;
                $row['name'] = isset($value->name)? $value->name:'N/A';
                $row['email'] = isset($value->email)? $value->email:'N/A';
                $row['telephone'] = isset($value->telephone)? $value->telephone:'N/A';
                $row['ipaddress'] = isset($value->ipaddress)? $value->ipaddress:'N/A';
                $row['activity_path'] = isset($value->activity_path)? $value->activity_path:'N/A';
                $row['country'] = isset($value->country)? $value->country:'N/A';
                $row['region'] = isset($value->region)? $value->region:'N/A';
                $row['city'] = isset($value->city)? $value->city:'N/A';
                $row['url'] = isset($value->url)? $value->url:'N/A';
                $row['message'] = isset($value->message)? $value->message:'N/A';
                $row['created_at'] = date('Y-m-d H:i:s', strtotime($value->created_at));
                
               
                $view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                $move = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                $row['actions']=createAction($view.$move);
                $datas[] = $row;
                $i++;
                //unset($u);
                
            }
           
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($total),
                "recordsTotal" => intval($total),
                'data'=> $datas

            ];
            return $return;
        }
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingArchive',$data);

    }

    public function frontend()
    {
        //$enquiry = Enquiry::where('user_type', '7')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.enquiry.listing', $data);
    }
   

    
    public function show(Request $request)
    {       

        
            $id = $request->id;
            //dd($id);
            $curl = curl_init();
//            dd($limit,$start);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.inventcolabssoftware.com/viewApi',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('id'=>$id)),
            );
        
             //dd(array('id'=>$id));
            $response = curl_exec($curl);
            //dd($response);die;
            curl_close($curl);
            
            $response1 = json_decode($response);
            
       
            //$total = $response1->res;
            $data = $response1->data[0];
            //dd($response);die;
            
        //$data = $this->Models->where('enquiries.id',$show_id)->first();
        //dd($data);
        $data= ['page'=>$this->page,'data'=>$data];
        //dd($data);die;
        return view('admin.'.$this->page.'.show',$data);
        
        
        
    }

    public function showArchive(Request $request)
    {
        $id = $request->id;
            //dd($id);
            $curl = curl_init();
//            dd($limit,$start);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.inventcolabssoftware.com/viewApi',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('id'=>$id)),
            );
        
             //dd(array('id'=>$id));
            $response = curl_exec($curl);
            
            curl_close($curl);
            
            $response1 = json_decode($response);
            //dd($response1);
       
            //$total = $response1->res;
            $data = $response1->data[0];
            //dd($data);
            
        //$data = $this->Models->where('enquiries.id',$show_id)->first();
        //dd($data);
        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.showArchive',$data);
    }


    public function moveArchive(Request $request){
        $input = $request->all();
        //dd($input);
        if($request->ajax()){
            $id = $request->id;
            
            // $oldTask = Enquiry::find($id);
            // $newTask = $oldTask->replicate(); 
            // $newTask->setTable('archives');
            // $newTask->live_enquire_id = $id;
            // $newTask->name = $request->name;
            // $newTask->save();

            $data = new Archive;
            
            $data->live_enquire_id = $id;
            
            $data->name = $request['name'] ?? null;
          
            $data->email = $request['email'] ?? null;
            $data->telephone = $request['telephone'] ?? null;
            $data->ipaddress = $request['ipaddress'] ?? null;
            $data->activity_path = $request['activity_path'] ?? null;
            $data->country = $request['country'] ?? null;
            $data->region = $request['region'] ?? null;
            $data->city = $request['city'] ?? null;

            $data->url = $request['url'] ?? null;
            $data->message = $request['message'] ?? null;
            $data->save();
        
            return response()->json(['success' => false]);
        }
         
    
    
    }

    public function archiveRemoveToIndex(Request $request){
        $input = $request->all();
       
        if($request->ajax()){
            $id = $request->id;
            Archive::where('live_enquire_id',$id)->delete();
          
        return response()->json(['success' => false]);
 
    }
    
    }

    public function moveIndex(Request $request){
        $input = $request->all();
       
        $id = $request->id;
        $type = $input['value'] ?? 'archive';
        $curl = curl_init();
//            dd($limit,$start);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.inventcolabssoftware.com/viewApi',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id'=>$id)),
        );
    
         //dd(array('id'=>$id));
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response1 = json_decode($response);
        //dd($response1);
   
        //$total = $response1->res;
        $data = $response1->data[0];
    
        if($data){
        $inserData = new Contact();
            $inserData->live_enquire_id = $id;
            $inserData->name = $data->name;
            $inserData->email = $data->email;
            $inserData->mobile_number = $data->telephone;
            $inserData->ipaddress = $data->ipaddress;
            $inserData->activity_path = $data->activity_path;
            $inserData->country = $data->country;
            //$inserData->country_location = $data->country_location;
            $inserData->region = $data->region;
            $inserData->city = $data->city;
            $inserData->url = $data->url;
            $inserData->message = $data->message;
            $inserData->type = $type;

            $inserData->save();
            
            $archiveData = new Archive;
            $archiveData->live_enquire_id = $id;
            $archiveData->save();
    //$data = $this->Models->where('enquiries.id',$show_id)->first();
    //dd($data);
        }
         $data= ['page'=>$this->page,'data'=>$data];
          
         return view('admin.'.$this->page.'.listing',$data);
    }

    
    

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
    public function status(Request $request)
    {
        $id = $request->id;
        try {
            $data = $this->Models->findOrFail($id);
            $data->type = $request->value;
            $data->save();
            return ['type'=>1,'message'=>'Status update Successfully.'];
        } catch (ModelNotFoundException $e) {
            return ['type'=>0,'message'=>'Something went wrong.'];
        }
    }

    public function changeStatus($id, $type)
    {
        $details = Archive::find($id);
        if (!empty($details)) {
            if ($type == 'contacts_lead' || $type == 'qualified_lead'||$type == 'business_submit_lead'||$type == 'cold_lead'||$type == 'won_lead'||$type == 'lost_lead') {
                $inp = ['type' => 1];
            } else {
                $inp = ['type' => 0];
            }
            $User = Archive::findOrFail($id);
            if ($User->update($inp)) {
                if ($type == 'contacts_lead' || $type == 'qualified_lead'|| $type == 'business_submit_lead'||$type == 'cold_lead'||$type == 'won_lead'||$type == 'lost_lead') {
                    $result['message'] = __("backend.Facility_Owner_status_success");
                    $result['type'] = 1;
                } else {
                    $result['message'] = __("backend.Facility_Owner_status_deactivate");
                    $result['type'] = 1;
                }
            } else {
                $result['message'] = __("backend.Facility_Owner_status_can`t_updated");
                $result['type'] = 0;
            }
        } else {
            $result['message'] = __("backend.Invaild_user");
            $result['type'] = 0;
        }
        return response()->json($result);
    }
}
