<?php

namespace App\Http\Controllers;
use App\Models\ColdLead;
use App\Models\LostLead;
use App\Models\BusinessLead;
use App\Models\WonLead;
use App\Models\QualifiedLead;
use App\Models\Enquiry;
use App\Models\Archive;
use App\Models\Language;
use App\Models\Link;
use App\Models\Secondarylanguages;
use App\Models\Candidate;
use App\Models\User;
use App\Models\LeadDashboard;
use App\Models\CurrentEmployee;
use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Contact;
use App\Models\PrimaryCountries;
use App\Models\SecondaryCountries;
use App\Models\ProjectTeam;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;
use File;
use DB;
use Carbon\Carbon;
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


class LeadDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'lead-dashboard';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->ModelsArchive = new Link(); 
        $this->sortableColumns = [
            0 => 'name',
            1 => 'email',
            2 => 'telephone',
            3 => 'ipaddress',
            4 => 'country_location',
            5 => 'message',
            10 => 'region',
            7 => 'city',
            8 => 'url',
            6 => 'created_at',
            9 => 'business_amount',
            11 => 'qualified_comment',
        ];

        

        $this->Models = new LeadDashboard(); 
        $this->sortableColumns= [
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
            16 => 'business_amount',
            17 => 'qualified_comment',
            

            
        ];
        $this->ModelsBusinessLead = new BusinessLead(); 
        $this->sortableColumnsArchive = [

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
            16 => 'business_amount',
            17 => 'qualified_comment',
            
        ];
        $this->ModelsqualifiedLead = new QualifiedLead(); 
        $this->sortableColumnsQualified = [

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
            16 => 'business_amount',
            17 => 'qualified_comment',

            
        ];

        $this->ModelswonLead = new WonLead(); 
        $this->sortableColumnsWon = [

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
            16 => 'business_amount',
            17 => 'qualified_comment',
            
        ];
        $this->ModelscoldLead = new ColdLead(); 
        $this->sortableColumnsCold = [

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
            16 => 'business_amount',
            17 => 'qualified_comment',
            
        ];
        $this->ModelslostLead = new LostLead(); 
        $this->sortableColumnsLost = [

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
            16 => 'business_amount',
            17 => 'qualified_comment',
            
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
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $min = $request['min'] ?? null ;
            $max = $request['max'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 7; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->ModelsArchive->getModel($search, $sortableColumns[$orderby], $order,$type,$start_date,$end_date,$user_type,$filter,$min,$max);
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
                $row['message'] = isset($value->message)? $value->message:'N/A';
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
               
                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                //$edit = editAction($this->page.'.edit',['id'=>$value->id]);
                
                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
                }else{
                    $row['type'] ='N/A';
                    $view = viewAction($this->page.'.show',['id'=>$value->id]);
                    $row['actions']=createAction($view);
                }
                

                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                
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
        if(isset($request->type)){
            $type = $request->type;

        }else{
            $type = null;
        }
         
       
        //dd($enquire);
        
        $data= ['page'=>$this->page,'user_type'=>$user_type,'type'=>$type];
       
        return view('admin.'.$this->page.'.listing',$data);

    
    }
   
    public function contactsLeadIndex(request $request){
       
        if ($request->ajax()) {   
                    
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $filter = $request['filter'] ?? null;
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $path = $request['path'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $min = $request['min'] ?? null ;
            $max = $request['max'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $user_type = 7; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$type,$start_date,$end_date,$user_type,$filter,$min,$max,$path);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['country_location'] = isset($value->country_location)? $value->country_location:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
               
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction business_popup',$this->page.'.status')->toHtml();
                
                 //$row['type'] = '<select class="form-control typeAction business_popup" style="width:100px" id="'.$value->id.'" data-path="'.customeRoute($path).'" data-value="'.$value->type.'" name="contacts"><option value="">Select</option><option value="archive">Archive</option><option value="contacts_lead" selected="selected">Contacts</option><option value="qualified_lead">Qualified</option><option value="business_submit_lead">Business Proposal Submitted</option><option value="won_lead">Won</option><option value="cold_lead">Cold</option><option value="lost_lead">Lost</option></select>';


                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);

                
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
               
                //$edit = editAction($this->page.'.edit',['id'=>$value->id]);
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);

              
                //$row['actions']=createAction($view.$delete);
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
        if(isset($request->type)){
            $type = $request->type;

        }else{
            $type = null;
        }
      
        $period = now()->subDays(30)->daysUntil(now());
      
        //$start_date = $request['start_date'] ?? null ;
        //$end_date = $request['end_date'] ?? null ;
        //$start = now()->subDays($start_date)->daysUntil($end_date);
        //$end = now()->subDays($end_date)->daysUntil($end_date);
        //$allDates = [];
        
        
       //dd($period);
            $monthWiseDates = [];
            
            $monthWiseLeads = [];
            $monthDates = [];
            $monthQualifiedEarning = [];
            $monthBusinessEarning = [];
            $monthWonEarning = [];
            $monthColdEarning = [];
            $monthLostEarning = [];
           
            //$startEarning = [];

            //$endEarning = [];

            // foreach($start as $date){

            //     $startEarning[] = $date->day.'-'.$date->month.'-'.$date->year;

            //     $startDates[] = [
            //         'day' => $date->day,
            //         'month' => $date->month,
            //         'year' => $date->year,
                 
            // ];

           

            // $start_query = Contact::select('created_at')->where('type', 'contacts_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();
                                     
            // $startLeads[] = $start_query;  
                                  
            
           
                
            // }
            

            foreach ($period as $date)
            {
                
               // $monthWiseDates[] = [
               //     'month' => $date->shortMonthName,
               //     'year' => $date->year,
               // ];
               $monthWiseDates[] = $date->day.'-'.$date->month.'-'.$date->year;
              //dd($monthWiseDates);
               $monthDates[] = [
                       'day' => $date->day,
                       'month' => $date->month,
                       'year' => $date->year,
                    
               ];
              
               
               $contacts_earning = Contact::select('created_at')->where('type', 'contacts_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();
               $qualified_earning = Contact::select('created_at')->where('type', 'qualified_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();
               $business_earning = Contact::select('created_at')->where('type', 'business_submit_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();

               $won_earning = Contact::select('created_at')->where('type', 'won_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();

               $cold_earning = Contact::select('created_at')->where('type', 'cold_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();

               $lost_earning = Contact::select('created_at')->where('type', 'lost_lead')->whereDate('created_at', $date->year.'-'.$date->month.'-'.$date->day)->count();
               
               //dd($total_earning);
               $monthWiseLeads[] = $contacts_earning;
               $monthQualifiedEarning[] = $qualified_earning;
               $monthBusinessEarning[] = $business_earning;
               $monthWonEarning[] = $won_earning;
               $monthColdEarning[] = $cold_earning;
               $monthLostEarning[] = $lost_earning;
                //dd($monthWiseLeads);
            }
             //dd($monthWiseDates);
            $last_12_months_list = implode(',', $monthWiseDates);
            $last_12_months_amount = implode(',',$monthWiseLeads);
            $monthQualifiedEarning = implode(',',$monthQualifiedEarning);
            $monthBusinessEarning = implode(',',$monthBusinessEarning);
            $monthWonEarning = implode(',',$monthWonEarning);
            $monthColdEarning = implode(',',$monthColdEarning);
            $monthLostEarning = implode(',',$monthLostEarning);
            


         
        // $contacts_lead = Contact::where('type','contacts_lead')->orderBy('created_at')->get()->count();
        
       
        // $qualifed_lead = Contact::where('type','qualified_lead')->orderBy('created_at')->get()->count();
        // $business_lead = Contact::where('type','business_submit_lead')->orderBy('created_at')->get()->count();
        // $won_lead = Contact::where('type','won_lead')->orderBy('created_at')->get()->count();
        // $cold_lead = Contact::where('type','cold_lead')->orderBy('created_at')->get()->count();
        // $lost_lead = Contact::where('type','lost_lead')->orderBy('created_at')->get()->count();
        
        // $monthlyData = implode(',', DB::table('contacts')->groupBy('created_at')->pluck('created_at')->toArray());
         //$monthlyData = date('d-m-Y',strtotime($monthlyData11));
         //dd($monthlyData);
        //$monthlyData = str_replace('"', "", $monthlyData11);
        
        $data= ['page'=>$this->page,'user_type'=>$user_type,'type'=>$type,'last_12_months_list'=>$last_12_months_list,
        'last_12_months_amount'=>$last_12_months_amount,
        'monthQualifiedEarning'=>$monthQualifiedEarning,'monthBusinessEarning'=>$monthBusinessEarning,'monthWonEarning'=>$monthWonEarning,
        'monthColdEarning'=>$monthColdEarning,'monthLostEarning'=>$monthLostEarning];
        //dd($data);
        return view('admin.'.$this->page.'.listingContactsLead',$data);
    }


    public function qualifiedLeadIndex(request $request){
       
        if ($request->ajax()) {   
            //$message =   $request['message'] ?? null;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sortableColumns = $this->sortableColumns;   
       
            $querydata = $this->ModelsqualifiedLead->getModel($search, $sortableColumns[$orderby],$start_date,$end_date, $order,$type);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
                
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                //$row['status'] = statusAction($value->status, $value->id,[0=>'Inactive',1=>'Active'],'statusAction',$this->page.'.status')->toHtml();


                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                
                //$view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                //$move =  $delete = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);

                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                //$row['actions']=createAction($view.$delete);
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
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingQualifiedLead',$data);

    }

    public function businessLeadIndex(request $request){
       
        if ($request->ajax()) {   
            //$message =   $request['message'] ?? null;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sortableColumns = $this->sortableColumns;   
       
            $querydata = $this->ModelsBusinessLead->getModel($search, $sortableColumns[$orderby],$start_date,$end_date, $order,$type);
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
                //dd($data);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();



                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                
                //$view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                //$move =  $delete = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                //$row['actions']=createAction($view.$delete);

                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();
                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
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
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingBusinessLead',$data);

    }

    public function wonLeadIndex(request $request){
       
        if ($request->ajax()) {   
            //$message =   $request['message'] ?? null;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sortableColumns = $this->sortableColumns;   
       
            $querydata = $this->ModelswonLead->getModel($search, $sortableColumns[$orderby],$start_date,$end_date, $order,$type);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();



                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                
                //$view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                //$move =  $delete = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);

                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                //$row['actions']=createAction($view.$delete);
                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
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
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingWonLead',$data);

    }

    public function coldLeadIndex(request $request){
       
        if ($request->ajax()) {   
            //$message =   $request['message'] ?? null;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sortableColumns = $this->sortableColumns;   
       
            $querydata = $this->ModelscoldLead->getModel($search, $sortableColumns[$orderby],$start_date,$end_date, $order,$type);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();



                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                
                //$view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                //$move =  $delete = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                //$row['actions']=createAction($view.$delete);
                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);


                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
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
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingColdLead',$data);

    }


    public function lostLeadIndex(request $request){
       
        if ($request->ajax()) {   
            //$message =   $request['message'] ?? null;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $type = $request['type'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $sortableColumns = $this->sortableColumns;   
       
            $querydata = $this->ModelslostLead->getModel($search, $sortableColumns[$orderby],$start_date,$end_date, $order,$type);
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
                $row['business_amount'] = isset($value->business_amount)? $value->business_amount:'N/A';
                $row['qualified_comment'] = isset($value->qualified_comment)? $value->qualified_comment:'N/A';
                $row['requirements'] = isset($value->requirements)? $value->requirements:'N/A';
                
                $row['linkedIn_url'] = isset($value->linkedin_url)? $value->linkedin_url:'N/A';
                $row['up_url'] = isset($value->up_url)? $value->up_url:'N/A';
                $row['bark_url'] = isset($value->bark_url)? $value->bark_url:'N/A';
                $row['image'] = isset($value->image)? $value->image:'N/A';
                $row['project_title'] = isset($value->project_title)? $value->project_title:'N/A';
                $row['role'] = isset($value->role)? $value->role:'N/A';
              
                $row['created_at'] = date('Y-m-d', strtotime($value->created_at));
                //$row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();



                // if($value->status==1) {
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,0]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you Sure you want to Inactivate this record?")\'>Active</a>';    
                // }else{
                //     $row['status']='<a href="'.route('admin.'.$this->page.'.status',[$value->id,1]).'" class="btn btn-primary btn-primary-light" onclick=\'return confirm("Are you sure you want to Activate this record?")\'>Inactive</a>';
                // }
               
               
                
                //$view = viewAction($this->page.'.showArchive',['id'=>$value->id]);
                //$move =  $delete = '<a href="javascript:void(0)" class="move_index" data-id="'.$value->id.'"><i class="fa fa-arrows"></i></a>';
                
                //$view = viewAction($this->page.'.show',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                //$delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                
                // $pdf = pdfAction($this->page.'.pdf',['id'=>$value->id]);
                 
                //$row['actions']=createAction($view.$delete);
                $login_user_data = auth()->user();
                if($login_user_data->user_type == 1){
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);
                $row['type'] = typeAction($value->type, $value->id,[''=>'Select','archive'=>'Archive','contacts_lead'=>'Contacts','qualified_lead'=>'Qualified','business_submit_lead'=>'Business Proposal Submitted','won_lead'=>'Won','cold_lead'=>'Cold','lost_lead'=>'Lost'],'typeAction',$this->page.'.status')->toHtml();

                $row['actions']=createAction($view.$delete);
            }else{
                $row['type'] ='N/A';
                $view = viewAction($this->page.'.show',['id'=>$value->id]);
                $row['actions']=createAction($view);
            }
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
        
      
        $data= ['page'=>$this->page];
       
        return view('admin.'.$this->page.'.listingLostLead',$data);

    }




   
       
        

    public function moveLead(Request $request){
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

            $data = new Link;
            
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

    public function optionalLeadAdd(){
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

            $data = new Contact;
            
            $data->business_amount = $request['business_amount'] ?? null;
            //$data->message = $request['message'] ?? null;
            $data->save();
        
            return response()->json(['success' => false]);
        }
    }



    public function frontend()
    {   
        $employee = Contact::where('user_type', '7')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.lead-dashboard.listing', $data);
    }

    // public function edit_frontend($id)
    // {
    //     $data['currentEmployee'] = LeadDashboard::findOrFail($id);
        
    //     return view('facility_owner.edit', $data);
    // }
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
            'employee_name'          => 'required|max:190',
            'official_email_address'         => 'required|email|unique:current_employees,official_email_address|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            'personal_email_address'         => 'required|email|unique:current_employees,personal_email_address|max:50|regex:/(.+)@(.+)\.(.+)/i', 
            'primary_contact_number' => 'required|numeric|unique:current_employees|digits:10|regex:/^([1-9][0-9\s\-\+\(\)]*)$/',
            //'emergency_contact_number' => 'required|numeric|unique:current_employees|digits:10|regex:/^([1-9][0-9\s\-\+\(\)]*)$/',
            'emergency_contact_number.digits' =>'The mobile number must be between 10 digits.',
            
        ]; 
        $message = [
            'primary_contact_number.digits' =>'The mobile number must be between 10 digits.',
            
        ];
            
        $this->validate($request,$validation,$message);       
        try{
            // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
          
            
            $data = new CurrentEmployee;
            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $result = file_upload($file, 'user');
            //          //dd($result);
            //     if ($result[0] == true) {
            //         $data->image = $result[1];
            //     }
            // }
           
            
            $data->employee_name = $input['employee_name'];
            $data->employee_department = $input['employee_department'];
            $data->primarySkills = implode(',',$input['primarySkills']);
            $data->secondarySkills = implode(',',$input['secondarySkills']);
            
            $data->primary_contact_number = $input['primary_contact_number'];
            $data->date_of_joining = $input['date_of_joining'];
            $data->official_email_address = $input['official_email_address'];
            //$data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
            //$data->primarySkills = implode(',',$input['primarySkills']);
            //if(isset($data->secondarySkills)){
            //$data->secondarySkills = implode(',',$input['secondarySkills']);
            //}
            $data->personal_email_address = $input['personal_email_address'];
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
                 
                    $data_user = new User;
                    $data_user->id = $data->id;
                    $data_user->name = $input['employee_name'];
                    $data_user->user_type = 4;
                    $data_user->email = $input['official_email_address'];
                    $data_user->password = Hash::make($randomPassword);
                    $data_user->remember_token = $secretKey;
                    $data_user->access_token = $randomPassword;
                    $data_user->status = '1';
                    if($data_user->save()){
                        Mail::send('emails.employeemail', compact('register_detail'), function ($message) use ($data, $email) {
                            $message->to($data->official_email_address, config('app.name'))->subject($email->subject);
                            $message->from('inventcolabs.demo@gmail.com', config('app.name'));
                        });
                        
                       
    
                    }
                }
            }
               
         return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
            
        } catch (Exception $e) {
            dd($e);
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
        // Gate::authorize('subadmin-create');
        // validate
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
             //'image.size'  =>  "Image is too large.",
        ];
        $this->validate($request, [
            'employee_name' => 'required|max:255',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'official_email_address' => 'required|email|unique:current_employees,official_email_address',
            'personal_email_address' => 'required|email|unique:current_employees,personal_email_address',
            'primary_contact_number' => 'required|digits:10|unique:current_employees,primary_contact_number',
            //'emergency_contact_number' => 'required|digits:10|unique:current_employees,emergency_contact_number',
            
            
            
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
                $data->employee_department = $input['employee_department'];
                $data->primarySkills = $input['primarySkills'];
                $data->secondarySkills = $input['secondarySkills'];
                $data->primary_contact_number = $input['primary_contact_number'];
                $data->date_of_joining = $input['date_of_joining'];
                $data->official_email_address = $input['official_email_address'];
                //$data->years_of_experience = $input['year'].'.'.$input['month'].' Years';
                $data->status = 1;
                $data->personal_email_address = $input['personal_email_address'];
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
            'official_email_address' => 'required|email|unique:current_employees,official_email_address,' . $id,
            'primary_contact_number' => 'required|numeric|digits:10|unique:current_employees,primary_contact_number,' .$id,
            'personal_email_address' => 'required|email|unique:current_employees,personal_email_address,' . $id,
            
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
                    $data = CurrentEmployee::where('id', $id)->update(['employee_name' => $input['employee_name'], 'employee_department' => $input['employee_department'],'primarySkills' => implode(',',$input['primarySkills']),'secondarySkills' => implode(',',$input['secondarySkills']),'primary_contact_number' => $input['primary_contact_number'],'date_of_joining' => $input['date_of_joining'],'official_email_address' => $input['official_email_address'],'personal_email_address' => $input['personal_email_address'],'emergency_contact_number' => $input['emergency_contact_number'],'image' => $result[1]]);
                    
                } else {
                    $data = CurrentEmployee::where('id', $id)->update(['employee_name' => $input['employee_name'], 'employee_department' => $input['employee_department'],'primarySkills' => implode(',',$input['primarySkills']),'secondarySkills' => implode(',',$input['secondarySkills']),'primary_contact_number' => $input['primary_contact_number'],'date_of_joining' => $input['date_of_joining'],'official_email_address' => $input['official_email_address'],'personal_email_address' => $input['personal_email_address'],'emergency_contact_number' => $input['emergency_contact_number']]);
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
        return response()->json(['success'=>"Lead Deleted successfully."]);
    }

    public function status(Request $request)
    {
        $id = $request->id;
        try {
            $data = $this->Models->findOrFail($id);
            $data->type = $request->value;
            // dd($request->value);
            if($request->value == 'business_submit_lead'){
                $data->business_amount = $request->business_amount;
                $data->qualified_comment = $request->qualified_comment;
            }
            //$data->business_amount = $request->archiveToBusiness;
            
            $data->save();
            return ['type'=>1,'message'=>'Status update Successfully.'];
        } catch (ModelNotFoundException $e) {
            return ['type'=>0,'message'=>'Something went wrong.'];
        }
    }

    public function changeStatus($id, $type)
    {
        $details = Contact::find($id);
        if (!empty($details)) {
            if ($type == 'contacts_lead' || $type == 'qualified_lead'||$type == 'business_submit_lead'||$type == 'cold_lead'||$type == 'won_lead'||$type == 'lost_lead') {
                $inp = ['type' => 1];
            } else {
                $inp = ['type' => 0];
            }
            $User = Contact::findOrFail($id);
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
