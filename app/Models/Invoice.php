<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bank;
use App\Models\Client;

class Invoice extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'client_name',
        'project_name',
        'currentCompany',
        'bank',
        'invoice_number',
        'milestone',
        'currency',
        'total_amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function getImageAttribute($value)
    // {
    //     if ($value) {
    //         if ($this->image_type == 'url') {
    //             return $value;
    //         } else {
    //             return url('uploads/user/' . $value);
    //         }
    //     } else {
    //         return url('images/default_user.png');
    //     }
    // }
     
    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type,$invoice_id_ajax,$project,$company) {
        $q = $this->select('invoices.*')->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'invoices.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('invoices.status',$status);
        }
             
        if(isset($project)){
            $q->where('invoices.project_name',$project);
        }
        
        if(isset($company)){
            $q->where('invoices.currentCompany',$company);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('invoices.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        if(isset($invoice_id_ajax)){
            $q->where('invoices.client_id',$invoice_id_ajax);
        }

        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('invoices.client_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.project_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.job_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.total_amount', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.bank', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.invoice_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoices.currency', 'LIKE', '%' . $search . '%');
                    
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }

    public function getBank(){
        return $this->hasOne(Bank::class,'id','bank');
    }

    public function client(){
        return $this->hasOne(Client::class,'id','client_id');
    }

   
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    

}
