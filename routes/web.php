<?php

use Illuminate\Support\Facades\Route;
use App\Models\Invoice;
//use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/clear-cache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want
});
Auth::routes(['verify' => true, 'register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // login route
    Route::POST('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::POST('login', 'Auth\LoginController@login')->name('login');

    Route::any('change-password', 'SettingController@changePassword')->name('change-password');
      
    Route::get('profile', 'SettingController@frontend')->name('profile');
    Route::post('/saveProfile', 'SettingController@saveProfile');
   
   
    
    Route::get('hradmin','UserController@index')->name('hradmin.index');  
    //Route::get('hradmin', 'UserController@frontend')->name('hradmin');
    Route::get('hradmin/create', 'UserController@create')->name('hradmin.create');
    Route::post('hradmin/store','UserController@store')->name('hradmin.store'); 
    Route::get('hradmin/edit','UserController@edit')->name('hradmin.edit');
    Route::get('hradmin/show','UserController@show')->name('hradmin.show');
    Route::get('hradmin/status','UserController@status')->name('hradmin.status');
    Route::post('hradmin/update','UserController@update')->name('hradmin.update'); 
    Route::get('hradmin/delete','UserController@destroy')->name('hradmin.delete');

    Route::get('hiringadmin','HiringController@index')->name('hiringadmin.index');          
    Route::get('hiringadmin/create','HiringController@create')->name('hiringadmin.create');    
    Route::post('hiringadmin/store','HiringController@store')->name('hiringadmin.store');      
    Route::get('hiringadmin/edit','HiringController@edit')->name('hiringadmin.edit');          
    Route::post('hiringadmin/update','HiringController@update')->name('hiringadmin.update');     
    Route::get('hiringadmin/show','HiringController@show')->name('hiringadmin.show');       
    Route::get('hiringadmin/status','HiringController@status')->name('hiringadmin.status');
    Route::get('hiringadmin/delete','HiringController@destroy')->name('hiringadmin.delete');

    Route::get('leadManager','LeadManagerController@index')->name('leadManager.index');          
    Route::get('leadManager/create','LeadManagerController@create')->name('leadManager.create');    
    Route::post('leadManager/store','LeadManagerController@store')->name('leadManager.store');      
    Route::get('leadManager/edit','LeadManagerController@edit')->name('leadManager.edit');          
    Route::post('leadManager/update','LeadManagerController@update')->name('leadManager.update');     
    Route::get('leadManager/show','LeadManagerController@show')->name('leadManager.show');       
    Route::get('leadManager/status','LeadManagerController@status')->name('leadManager.status');
    Route::get('leadManager/delete','LeadManagerController@destroy')->name('leadManager.delete');



    Route::get('department','DepartmentController@index')->name('department.index');          
    Route::get('department/create','DepartmentController@create')->name('department.create');    
    Route::post('department/store','DepartmentController@store')->name('department.store');      
    Route::get('department/edit','DepartmentController@edit')->name('department.edit');          
    Route::post('department/update','DepartmentController@update')->name('department.update');     
    Route::get('department/show','DepartmentController@show')->name('department.show');       
    Route::get('department/status','DepartmentController@status')->name('department.status');
    Route::get('department/delete','DepartmentController@destroy')->name('department.delete');



    Route::get('technology','TechnologyController@index')->name('technology.index');          
    Route::get('technology/create','TechnologyController@create')->name('technology.create');    
    Route::post('technology/store','TechnologyController@store')->name('technology.store');      
    Route::get('technology/edit','TechnologyController@edit')->name('technology.edit');          
    Route::post('technology/update','TechnologyController@update')->name('technology.update');     
    Route::get('technology/show','TechnologyController@show')->name('technology.show');       
    Route::get('technology/status','TechnologyController@status')->name('technology.status');
    Route::get('technology/delete','TechnologyController@destroy')->name('technology.delete');




    Route::get('candidate','CandidateController@index')->name('candidate.index');        
    Route::get('candidate/create','CandidateController@create')->name('candidate.create');    
    Route::post('candidate/store','CandidateController@store')->name('candidate.store'); 
    Route::get('candidate/edit','CandidateController@edit')->name('candidate.edit');          
    Route::post('candidate/update','CandidateController@update')->name('candidate.update');     
    Route::get('candidate/show','CandidateController@show')->name('candidate.show');       
    Route::get('candidate/status','CandidateController@status')->name('candidate.status');
    //Route::get('candidate/DocumentInfo','CandidateController@candidateDocumentInfo')->name('candidate.candidateDocumentInfo');

    Route::get('candidate/pdf','CandidateController@pdfDownload')->name('candidate.pdf');
    
    Route::get('candidate/documentListing','CandidateController@documentListing')->name('candidate.documentListing');
    // Route::post('projects/taskcreate','CandidateController@taskcreate')->name('projects.taskcreate');
    Route::get('candidate/documentcreate','CandidateController@documentcreate')->name('candidate.documentcreate');
    Route::post('candidate/documentstore','CandidateController@documentstore')->name('candidate.documentstore');
    Route::get('candidate/documentshow','CandidateController@documentshow')->name('candidate.documentshow');  
    Route::get('candidate/documentedit','CandidateController@documentedit')->name('candidate.documentedit'); 
    Route::post('candidate/documentupdate','CandidateController@documentupdate')->name('candidate.documentupdate');  
    Route::post('candidate/delete','CandidateController@delete')->name('candidate.delete');

    Route::get('candidate/informationListing','CandidateController@informationListing')->name('candidate.informationListing');
    // Route::post('projects/taskcreate','CandidateController@taskcreate')->name('projects.taskcreate');
    Route::get('candidate/informationcreate','CandidateController@informationcreate')->name('candidate.informationcreate');
    Route::post('candidate/informationstore','CandidateController@informationstore')->name('candidate.informationstore');
    Route::get('candidate/informationshow','CandidateController@informationshow')->name('candidate.informationshow');  
    Route::get('candidate/informationedit','CandidateController@informationedit')->name('candidate.informationedit'); 
    Route::post('candidate/informationupdate','CandidateController@informationupdate')->name('candidate.informationupdate');  
    Route::post('candidate/delete','CandidateController@delete')->name('candidate.delete');



    Route::get('currentEmployee','CurrentemployeeController@index')->name('currentEmployee.index');        
    Route::get('currentEmployee/create','CurrentemployeeController@create')->name('currentEmployee.create');    
    Route::post('currentEmployee/store','CurrentemployeeController@store')->name('currentEmployee.store');      
    Route::get('currentEmployee/edit','CurrentemployeeController@edit')->name('currentEmployee.edit');          
    Route::post('currentEmployee/update','CurrentemployeeController@update')->name('currentEmployee.update');     
    Route::get('currentEmployee/show','CurrentemployeeController@show')->name('currentEmployee.show');       
    Route::get('currentEmployee/status','CurrentemployeeController@status')->name('currentEmployee.status');
    Route::get('currentEmployee/delete','CurrentemployeeController@destroy')->name('currentEmployee.delete');
    Route::post('currentEmployee/documents', 'CurrentemployeeController@upload')->name('currentEmployee.upload');

    
    Route::get('projects','ProjectController@index')->name('projects.index');        
    Route::get('projects/create','ProjectController@create')->name('projects.create');    
    Route::post('projects/store','ProjectController@store')->name('projects.store');      
    Route::get('projects/edit','ProjectController@edit')->name('projects.edit');          
    Route::post('projects/update','ProjectController@update')->name('projects.update');     
    Route::get('projects/show','ProjectController@show')->name('projects.show');       
    Route::get('projects/status','ProjectController@status')->name('projects.status');
    Route::get('projects/delete','ProjectController@destroy')->name('projects.delete');

    Route::get('projects/task','ProjectController@task')->name('projects.task');
    // Route::post('projects/taskcreate','ProjectController@taskcreate')->name('projects.taskcreate');
    Route::get('projects/taskcreate','ProjectController@taskcreate')->name('projects.taskcreate');
    Route::post('projects/taskstore','ProjectController@taskstore')->name('projects.taskstore');
    Route::get('projects/taskshow','ProjectController@taskshow')->name('projects.taskshow');     
    Route::post('projects/delete','ProjectController@delete')->name('projects.delete');
    

    Route::get('projectss','ProjectHiringController@index')->name('projectss.index');        
    Route::get('projectss/create','ProjectHiringController@create')->name('projectss.create');    
    Route::post('projectss/store','ProjectHiringController@store')->name('projectss.store');      
    Route::get('projectss/edit','ProjectHiringController@edit')->name('projectss.edit');          
    Route::post('projectss/update','ProjectHiringController@update')->name('projectss.update');     
    Route::get('projectss/show','ProjectHiringController@show')->name('projectss.show');       
    Route::get('projectss/status','ProjectHiringController@status')->name('projectss.status');
    Route::get('projectss/delete','ProjectHiringController@destroy')->name('projectss.delete');

    Route::get('employeeProjects/index','EmployeeProjectController@index')->name('employeeProjects.index'); 
    Route::get('employeeProjects', 'EmployeeProjectController@frontend')->name('employeeProjects');       
    Route::get('employeeProjects/create','EmployeeProjectController@create')->name('employeeProjects.create');    
    Route::post('employeeProjects/store','EmployeeProjectController@store')->name('employeeProjects.storfore');      
    Route::get('employeeProjects/edit','EmployeeProjectController@edit')->name('employeeProjects.edit');          
    Route::post('employeeProjects/update','EmployeeProjectController@update')->name('employeeProjects.update');     
    Route::get('employeeProjects/show','EmployeeProjectController@show')->name('employeeProjects.show');       
    Route::get('employeeProjects/status','EmployeeProjectController@status')->name('employeeProjects.status');
    Route::get('employeeProjects/delete','EmployeeProjectController@destroy')->name('employeeProjects.delete');

    Route::get('employeeProjects/show/{id}', 'EmployeeProjectController@show')->name('employeeProjects.show');
    Route::get('employeeProjects/employeeTask/{id}', 'EmployeeProjectController@employeeTask')->name('employeeProjects.employeeTask');
    Route::get('employeeProjects/taskView/{id}', 'EmployeeProjectController@taskView')->name('employeeProjects.taskView');

    Route::get('clients','ClientController@index')->name('clients.index'); 
    //Route::get('clients', 'ClientController@frontend')->name('clients');               
    Route::get('clients/create','ClientController@create')->name('clients.create');    
    Route::post('clients/store','ClientController@store')->name('clients.store');      
    Route::get('clients/edit','ClientController@edit')->name('clients.edit');          
    Route::post('clients/update','ClientController@update')->name('clients.update');     
    Route::get('clients/show','ClientController@show')->name('clients.show');       
    Route::get('clients/status','ClientController@status')->name('clients.status');
    Route::get('clients/delete','ClientController@destroy')->name('clients.delete');


    Route::get('invoices','InvoiceController@index')->name('invoices.index'); 
    //Route::get('clients', 'ClientController@frontend')->name('clients');               
    Route::get('invoices/create','InvoiceController@create')->name('invoices.create');    
    Route::post('invoices/store','InvoiceController@store')->name('invoices.store');      
    Route::get('invoices/edit','InvoiceController@edit')->name('invoices.edit');          
    Route::post('invoices/update','InvoiceController@update')->name('invoices.update');     
    Route::get('invoices/show','InvoiceController@show')->name('invoices.show');       
    Route::get('invoices/status','InvoiceController@status')->name('invoices.status');
    Route::get('invoices/delete','InvoiceController@destroy')->name('invoices.delete');
    Route::post('invoices/received-amount','InvoiceController@receivedAmount')->name('invoices.receivedAmount');
    Route::get('invoices/show-project','InvoiceController@showProject')->name('invoices.show-project');
    
    Route::get('invoices/show-milstone','InvoiceController@showMilstone')->name('invoices.show-milstone');
    // Route::post('invoices/show-milstone','InvoiceController@showMilstone')->name('invoices.show-milstone');

    // Show Currency
    Route::get('invoices/show-currency','InvoiceController@showCurrency')->name('invoices.show-currency');

    // Show Amount 
    Route::get('invoices/show-total_amount','InvoiceController@showAmount')->name('invoices.show-total_amount');
    
    Route::get('invoices/download-pdf/{id}','InvoiceController@downloadPDF')->name('invoices.downloadPdf');
    

    Route::get('contacts','ContactController@index')->name('contacts.index');        
    Route::get('contacts/create','ContactController@create')->name('contacts.create');
    Route::post('checkEmail', 'ContactController@checkEmail');   
    Route::post('checkPhone', 'ContactController@checkPhone');  
    Route::post('contacts/store','ContactController@store')->name('contacts.store');      
    Route::get('contacts/edit','ContactController@edit')->name('contacts.edit');          
    Route::post('contacts/update','ContactController@update')->name('contacts.update');     
    Route::get('contacts/show','ContactController@show')->name('contacts.show');       
    Route::get('contacts/status','ContactController@status')->name('contacts.status');
    Route::get('contacts/delete','ContactController@destroy')->name('contacts.delete');
    Route::delete('delete1', 'ContactController@delete');


    Route::get('extracts','ExtractController@index')->name('extracts.index');        
    //Route::get('extracts/create','ExtractController@create')->name('extracts.create');
    Route::post('checkEmail', 'ExtractController@checkEmail');   
    Route::post('checkPhone', 'ExtractController@checkPhone');  
    //Route::post('extracts/store','ExtractController@store')->name('extracts.store');      
    //Route::get('extracts/edit','ExtractController@edit')->name('extracts.edit');          
    //Route::post('extracts/update','ExtractController@update')->name('extracts.update');     
    Route::get('extracts/show','ExtractController@show')->name('extracts.show');       
    //Route::get('extracts/status','ExtractController@status')->name('extracts.status');
    //Route::get('extracts/delete','ExtractController@destroy')->name('extracts.delete');
    //Route::delete('delete1', 'ExtractController@delete');
    
    Route::get('enquiry','EnquirieController@index')->name('enquiry.index');
    Route::get('enquiry/show','EnquirieController@show')->name('enquiry.show'); 
    Route::post('move','EnquirieController@moveArchive');
    Route::get('moveIndex','EnquirieController@moveIndex');

    //Route::post('archiveRemoveToIndex','EnquirieController@archiveRemoveToIndex');
    Route::get('enquiry/archive','EnquirieController@archiveIndex')->name('enquiry.archiveIndex');
    Route::get('enquiry/archive/showArchive','EnquirieController@showArchive')->name('enquiry.showArchive'); 
    Route::get('/dashboard', 'HomeController@index')->name('home')->middleware(['verified', 'auth']);

    // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    //Route::get('enquiry','EnquirieController@index')->name('enquiry.index'); 


    Route::get('lead-dashboard','LeadDashboardController@index')->name('lead-dashboard.index');        
    Route::get('lead-dashboard/create','LeadDashboardController@create')->name('lead-dashboard.create');    
    Route::post('lead-dashboard/store','LeadDashboardController@store')->name('lead-dashboard.store');      
    Route::get('lead-dashboard/edit','LeadDashboardController@edit')->name('lead-dashboard.edit');          
    Route::post('lead-dashboard/update','LeadDashboardController@update')->name('lead-dashboard.update');     
    Route::get('lead-dashboard/show','LeadDashboardController@show')->name('lead-dashboard.show');       
    Route::get('lead-dashboard/status','LeadDashboardController@status')->name('lead-dashboard.status');
    Route::get('lead-dashboard/delete','LeadDashboardController@destroy')->name('lead-dashboard.delete');
    //Route::delete('delete_leads', 'LeadDashboardController@delete');
    //Route::get('move','LeadDashboardController@moveLead');
    //Route::get('path','LeadDashboardController@status');
    //Route::get('lead-dashboard/archive-lead','LeadDashboardController@leadIndex')->name('lead-dashboard.leadIndex');
    
    
    Route::get('lead-dashboard/contacts-lead','LeadDashboardController@contactsLeadIndex')->name('lead-dashboard.contactsLeadIndex');
    Route::get('lead-dashboard/qualified-lead','LeadDashboardController@qualifiedLeadIndex')->name('lead-dashboard.qualifiedLeadIndex');
    Route::get('lead-dashboard/business-lead','LeadDashboardController@businessLeadIndex')->name('lead-dashboard.businessLeadIndex');
    Route::get('lead-dashboard/won-lead','LeadDashboardController@wonLeadIndex')->name('lead-dashboard.wonLeadIndex');
    Route::get('lead-dashboard/cold-lead','LeadDashboardController@coldLeadIndex')->name('lead-dashboard.coldLeadIndex');
    Route::get('lead-dashboard/lost-lead','LeadDashboardController@lostLeadIndex')->name('lead-dashboard.lostLeadIndex');

    //Route::post('login_time', 'HomeController@index');
    
    Route::get('bank','BankController@index')->name('bank.index');  
    //Route::get('bank', 'BankController@frontend')->name('bank');
    Route::get('bank/create', 'BankController@create')->name('bank.create');
    Route::post('bank/store','BankController@store')->name('bank.store'); 
    Route::get('bank/edit','BankController@edit')->name('bank.edit');
    Route::get('bank/show','BankController@show')->name('bank.show');
    Route::get('bank/status','BankController@status')->name('bank.status');
    Route::post('bank/update','BankController@update')->name('bank.update'); 
    Route::get('bank/delete','BankController@destroy')->name('bank.delete');

    Route::get('getBankList', function (Request $request) {
        $data = ['data'=>$request::all()];
        return view('admin.bank.bankList',$data);
    });


    /* Route::get('getInvoice', function (Request $request) {

        $data   = $request::all();
        $value  = $data['value'];
        $year   = '';
        if(date('Y-04-01') > date('Y-m-d')){
            $year = date('Y').'-'.(date('y')-1);
        }else{ // Extra
            $year = date('Y').'-'.(date('y')+1); // Extra
        }
        $total_invoice = Invoice::count();
        $total_invoice = $total_invoice+1;

        return (substr($value[0],0,2).substr($value[1],0,1).'|'. $year.'|'. date('M').'|'.'00'.$total_invoice);
    }); */

    Route::get('getInvoice', function (Request $request) {
        $data   = $request::all();
        $value  = explode(' ',$data['value']);

        $year = '';
        if(date('Y-03-01') > date('Y-m-d')){
            $year = date('Y').'-'.(date('y')+1);
        }else{
            $year = date('Y').'-'.(date('y')+1);
        }

        $total_invoice  =   Invoice::whereMonth('created_at', date('m'))->count();
        $total_invoice  =   $total_invoice + 1;
        
        /* if($total_invoice == 0){
        }elseif($total_invoice > 0){
            $total_invoice  =   $total_invoice + 1;
        } */

        return (substr($value[0],0,2).substr($value[1],0,1).'|'. $year.'|'. date('M').'|'.'00'.$total_invoice);

    });
    
});