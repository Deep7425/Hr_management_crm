<?php

namespace App\Http\Controllers;
use App\Models\CurrentEmployee;
use App\Models\Language;
use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Bank;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use File,DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Courts;
use Spatie\Permission\Models\Role;
// use App\Exports\FacilityOwnerExport;
use App\Models\PasswordReset as ModelsPasswordReset;
use Exception,Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $page = 'invoices';
    protected  $table;

    public function __construct() {
        $this->middleware('auth');
        $this->Models = new Invoice(); 
        $this->sortableColumns = [
            0 => 'client_name',
            1 => 'project_name',
            2 => 'currentCompany',
            3 => 'bank',
            4 => 'invoice_number',
            5 => 'milestone',
            6 => 'currency',
            7 => 'total_amount',
            8 => 'status',
            9 => 'created_at',
        ];
    }

    public function index(Request $request)
    { 
       
       
        if ($request->ajax()) {   
            $invoice_id_ajax = $request->input('client_id');
             //dd($invoice_id_ajax);
            $data = $this->Models->where('invoices.client_id',$invoice_id_ajax)->get();  
          
            //dd($invoice_id_ajax);
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $status = $request['status'] ?? null;
            $start_date = $request['start_date'] ?? null ;
            $end_date = $request['end_date'] ?? null; 
            $project = $request['project'] ?? null; 
            $company = $request['company'] ?? null; 
            $user_type = 6; 
            $sortableColumns = $this->sortableColumns;            
            $querydata = $this->Models->getModel($search, $sortableColumns[$orderby], $order,$status,$start_date,$end_date,$user_type,$invoice_id_ajax,$project,$company);
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
                $row['client_id'] = isset($value->client_id)? $value->client_id:'N/A';
                $row['client_name'] = isset($value->client_name)? $value->client_name:'N/A';
                $row['project_name'] = isset($value->project_name)? $value->project_name:'N/A';
                $row['currentCompany'] = isset($value->currentCompany)? $value->currentCompany:'N/A';
                $row['invoice_number'] = isset($value->invoice_number)? $value->invoice_number:'N/A';

                $row['currency'] = isset($value->currency)? $value->currency:'N/A';
                
                $row['received_amount'] = isset($value->received_amount)? $value->received_amount:'N/A';

                // $row['reference'] = isset($value->reference)? $value->reference:'N/A';
                // $row['memo'] = isset($value->memo)? $value->memo:'N/A';
                $row['milestone'] = isset($value->milestone)? $value->milestone:'N/A';

                if(!empty($value->currency)){
                    $currency   =   $value->currency;
                }else{
                    $currency   =   '';
                }

                $row['total_amount'] = isset($value->total_amount)? $currency.' '.$value->total_amount:'N/A';
                $row['created_at'] = date('d M Y', strtotime($value->created_at));

                if($value->status == 2){
                    $row['status']=statusAction($value->status, $value->id,[2=>'Received'],'statusAction',$this->page.'.status')->toHtml();
                }else{
                    $row['status']=statusAction($value->status, $value->id,[0=>'Pending',1=>'Active',2=>'Received'],'statusAction',$this->page.'.status')->toHtml();
                }

                $row['role'] = isset($value->role)? $value->role:'N/A';
                
                $edit = editAction($this->page.'.edit',['id'=>$value->id]);
                $delete = deleteAction($this->page.'.delete',['id'=>$value->id]);

                $view = viewAction($this->page.'.show',['id'=>$value->id]);

                $download = '<a href="'.customeRoute($this->page.'.downloadPdf',$value->id).'" title="Download" class="ms-1"><i class="bx bx-download"></i></a>';
                
                if($value->status == 2){
                    $row['actions']=createAction($view.$download);
                }else{
                    $row['actions']=createAction($edit.$view.$delete);
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
      
        $beneficiaryList = Bank::select('beneficiary_name')->distinct()->get();
        $projects = Project::all();

        $data= ['page'=>$this->page,'user_type'=>$user_type,'status'=>$status,'beneficiaryList'=>$beneficiaryList,'projects'=>$projects];
        return view('admin.'.$this->page.'.listing',$data);
    }


    public function frontend()
    {
    
        //$invoice = Invoice::where('user_type', '6')->get();
        $data= ['page'=>$this->page]; 
        return view('admin.invoices.listing', $data);
    }

    public function edit_frontend($id)
    {
        $data['invoice'] = Invoice::findOrFail($id);
        
        return view('facility_owner.edit', $data);
    }
 



    
    

    public function create(Request $request)    
    {
        
        $client['client_name'] = Client::all();
        $data['project_list'] = Project::all();
        $data['currentCompanyList'] = Candidate::all();
        $data['beneficiaryList']= Bank::select('beneficiary_name')->distinct()->get();
        $record = Invoice::latest()->first();
        if(isset($record) && $record != null){
            $invoice_number = $record->invoice_number;

       

                $milestone   = explode(",",$record->milestone);

                $total_amount  = explode(',',$record->total_amount);

                $currency        = explode(',',$record->currency);


            $invoice_number1 = explode(" ",$invoice_number);
            $invoice_number2 = (int)$invoice_number1[0] +1;
            $new_invoice_number = '00'.$invoice_number2.'-'.date('mdY');
        }else{
            $new_invoice_number = '00101-'.date('mdY');
        }

        $data['button'] = 'Save';
        $data= ['page'=>$this->page,'data'=> $data,'new_invoice_number'=>$new_invoice_number,'client'=>$client ,  
        'data' => $data ,  'milestone'=> [] ,'total_amount' =>[] ,     'currency'  =>[]  ];  

        return view('admin.'.$this->page.'.create',$data);

    }



    public function store(Request $request)
    { 
        $input = $request->all();
        $validation = [
          'client_name'          => 'required|max:190',
            // 'currency'          => 'required',
            // 'milestone_name'          => 'required',
            // 'total_amount'          => 'required',
            'currentCompany'          => 'required',
            // 'project_name'          => 'required',
            // 'bank'          => 'required',
            // 'reference'          => 'required',
        ]; 
        $this->validate($request,$validation);       
     
           
            $data = new Invoice;
            // echo "<pre>";
            // print_r($request->all());die;

            $data->client_id = $input['client_name'];
            $data->client_name = $input['client_name'];
            $data->project_name = $input['project_name'];
            $data->currentCompany = $input['currentCompany'];
            $data->invoice_number = $input['invoice_number'];
            $data->bank = $input['bank'];

         
            // $data->reference = $input['reference'];
            // $data->milestone = $input['milestone'];
            // $data->total_amount = $input['total_amount'];
            // $data->currency = $input['currency'];

            $data->milestone = implode(',', $input['milestone'][0]);
            $data->total_amount = implode(',', $input['total_amount'][0]);
            $data->currency = implode(',', $input['currency'][0]);

            $data->status = 0;
            $data->user_type = 6;
            $data->role = 'invoices';
            $data->save();
            return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
         
    }


    // public function store(Request $request)
    // { 
    //     $input = $request->all();

    //     $validation = [
    //         'client_name'          => 'required|max:190',
    //         // 'currency'          => 'required',
    //         // 'milestone_name'          => 'required',
    //         // 'total_amount'          => 'required',
    //         // 'currentCompany'          => 'required',
    //         'project_name'          => 'required',
    //         'bank'          => 'required',
            
    //     ]; 

    //     $this->validate($request,$validation);       
    
    //         // $secure_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
    //         $data = new Invoice;
          

  

    //         $data->client_id = $input['client_name'];
    //         $data->client_name = $input['client_name'];
    //         $data->project_name = $input['project_name'];
    //         $data->currentCompany = $input['currentCompany'];
    //         $data->invoice_number = $input['invoice_number'];
    //         $data->bank = $input['bank'];
    //         $data->milestone = implode(',', $input['milestone']);
    //         $data->total_amount = implode(',', $input['total_amount']);
    //         $data->currency = implode(',', $input['currency']);

    //         // $data->milestone = $input['milestone'];
    //         // $data->total_amount = $input['total_amount'];
    //         // $data->currency = $input['currency'];
    //         $data->status = 0;
    //         $data->user_type = 6;
    //         $data->role = 'invoice';

    //         $data->save();
    //         return Redirect::route('admin.'.$this->page.'.index')->with('success','Record added successfully');
        
    // }



    public function show(Request $request)
    {   
        
        
        $id     =   $request->id;
        $data   =   $this->Models->with('getBank','client')->where('invoices.id',$id)->first();

        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.show',$data);
    }


    public function edit(Request $request)
    {
        
        $id = $request->id;
        
        $data = $this->Models->find($id);
        // dd($data);   
        $client['client_name'] = Client::all();
        $data['project_list'] = Project::all();
        $data['currentCompanyList'] = Candidate::all();
        $data['button'] = 'Update';
        $data['bankList']= Bank::all();
        
        $record = Invoice::latest()->first();
        if(isset($record) && $record != null){
            $invoice_number = $record->invoice_number;
            $invoice_number1 = explode(" ",$invoice_number);
            $invoice_number2 = (int)$invoice_number1[0] +1;
            $new_invoice_number = '00'.$invoice_number2.'-'.date('mdY').'-PRJ';
             
        }else{
            $new_invoice_number = '00101-'.date('mdY').'-PRJ';
        }    
        $data['button'] = 'Update';
        $data['beneficiaryList']= Bank::select('beneficiary_name')->distinct()->get();

        $data= ['page'=>$this->page,'data'=>$data,'new_invoice_number'=>$new_invoice_number,'client'=>$client , 'data' => $data , 'data' => $data];
        return view('admin.'.$this->page.'.edit',$data);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $message = [];       
        $this->validate($request, [
            'client_name' => 'required|max:255',
        ], $message);

        $input = $request->all();
        $fail = false;

        if (!$fail) {
            try {

                $invoiceData  = Invoice::where('id',$id)->first();

                $data    =   Invoice::findOrFail($id);
                $data->client_id = $input['client_name'];
                $data->client_name = $input['client_name'];
                $data->project_name = $input['project_name'];
                $data->currentCompany = $input['currentCompany'];
                $data->invoice_number = $input['invoice_number'];
           
                // $data->reference = $input['reference'];
             
                $data->milestone = $input['milestone_name'];
                $data->total_amount = $input['total_amount'];
                $data->currency = !empty($input['currency']) ? $input['currency'] : $invoiceData->currency;
                $data->bank = $input['bank'];
                $data->save();

                return Redirect::route('admin.invoices.index')->with('success',"Record updated successfully.");
            } catch (Exception $e) {
                return Redirect::Back()->with('error',"Something went wrong.");
            }
        } else {
            return Redirect::Back()->with('error',"Something went wrong.");
        }
    }

   
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data =  Invoice::findOrFail($id)->delete();
        $data= ['page'=>$this->page,'data'=>$data];
        return view('admin.'.$this->page.'.listing',$data);
       
    }

    public function receivedAmount(Request $request)
    {
        $id = $request->id;
        $input = $request->all();

        $validator = Validator::make($input, [
            'amount_type' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message'   => "Validation Required."]);  

        } else {

            try {
                $id                     =   $request->invoice_id;
                $data                   =   Invoice::findOrFail($id);
                $data->received_amount  =   $request->amount;
                $data->amount_type      =   $request->amount_type;
                $data->status           =   2; // Received Amount
                if($data->save()){
                    return response()->json(['status' => true, 'message'   => "Amount Received Successfully."]);  
                }else{
                    return response()->json(['status' => false, 'message'   => "Something went wrong, please try again later."]);  
                }
            } catch (Exception $e) {
                return Redirect::Back()->with('error',"Something went wrong.");
            }
        }
    }

    public function downloadPDF($id,Request $request)
    {
        $data = $this->Models->with('getBank','client')->where('invoices.id',$id)->first();
        $pdf = PDF::loadView('admin.'.$this->page.'.pdfView', compact('data'));
        $pdfName    =   $data->invoice_number;
        $fileName  = str_replace('|','-',$pdfName);
        return $pdf->download($fileName.'.pdf');
    }


    public function showProject(Request $request)
    {
        $client_id      =   $request->client_id;
        $projects       =   Project::where('client_name',$client_id)->get();

        $invoice        =   Invoice::where('id',$request->invoice_id)->first();

        if(!empty($projects)){
            $data['message'] = "Projects Get Successfully";
            $data['projects'] = $projects;
            $data['status']   =   1;
            $data['invoice']   =   $invoice;
        }else{
            $data['message']  =   "Projects Not Found";
            $data['invoice']   =  $invoice;
            $data['status']   =   0;
            $data['projects']     =   [];
        }

        return view('admin.'.$this->page.'.show_projects',$data);

    }

    public function showMilstone(Request $request)
    {
        $project_name   =   $request->project_name;
        $projects       =   Project::where('project_name',$project_name)->get();
        // dd($projects);
        // echo"<pre>";print_r($projects);die;
        $invoice        =   Invoice::where('id',$request->invoice_id)->first();
        //   dd($invoice);
     
        if(!empty($projects)){
            $data['message'] = "Milestone Get Successfully";
            $data['projects'] = $projects;
                    // dd($projects);
            $data['status']   =   1;
            $data['invoice']   =   $invoice;
        }else{
            $data['message']  =   "Milestone Not Found";
            $data['status']   =   0;
            $data['projects']     =   [];
            $data['invoice']   =  $invoice;
        }

        return view('admin.'.$this->page.'.show_milestones',$data);

    }
}
//     public function showCurrency(Request $request)
//     {
//         $project_name     =   $request->project_name;
       
//         $projects           =   Project::where('project_name',$project_name)->get();
//         // dd($projects);rrenc
//         $invoice            =   Invoice::where('id',$request->invoice_id)->first();

//         // dd($invoice);
//         // echo"<pre>";print_r($milestone_name);die;
//         if(!empty($projects)){
//             $data['message'] = "Currency Get Successfully";
//             $data['projects'] = $projects;
//             // dd($data['projects']);
//             $data['status']   =   1;
//             $data['invoice']   =   $invoice;
//         }else{
//             $data['message']  =   "Currency Not Found";
//             $data['status']   =   0;
//             $data['projects']     =   [];
//             // $data['invoice']   =  $invoice;
//         }

//         // dd($data);
//         return view('admin.'.$this->page.'.show_currency',$data);

//     }


//     public function showAmount(Request $request)
//     {
//         $project_name     =   $request->project_name;
//         $projects           =   Project::where('project_name',$project_name)->get();
//         $invoice            =   Invoice::where('id',$request->invoice_id)->first();
     
//         // echo"<pre>";print_r($milestone_name);die;
//         if(!empty($projects)){
//             $data['message'] = "Currency Get Successfully";
//             $data['projects'] = $projects;
//             dd($projects);
//             $data['status']   =   1;
//             $data['invoice']   =   $invoice;
//         }else{
//             $data['message']  =   "Currency Not Found";
//             $data['status']   =   0;
//             $data['projects']     =   [];
//             // $data['invoice']   =  $invoice;
//         }

//         return view('admin.'.$this->page.'.show_total_amount',$data);

//     }


// }




