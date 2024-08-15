<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Enquiry;
use DB;
class LeadDashboard extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    //protected $table = 'archives';
    protected $fillable = [
             
             'project_title',
             'name',
             'email',
             'alternate_email',
             'mobile_number',
             'primary_country',
             'secondary_country',
             'requirements',
             'linkedIn_url',
             'up_url',
             'image',
             'status',
             'created_at',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            if ($this->image_type == 'url') {
                return $value;
            } else {
                return url('public/' . $value);
            }
        } else {
            return url('images/default_user.png');
        }
    }

    public function getModel($search=null, $orderby=null, $order=null,$type='archive',$start_date,$end_date,$user_type, $filter ,$min,$max) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        
       
    
        
            //$q = $this->select('contacts.*');
             


            $q = $this->select('contacts.*')
            ->where('type', '!=', 'archive')
            ->where('type', '!=', 'qualified_lead')
            ->where('type', '!=', 'business_submit_lead')
            ->where('type', '!=', 'won_lead')
            ->where('type', '!=', 'cold_lead')
            ->where('type', '!=', 'lost_lead');
            

            
            //->where('type', '=', 'qualified_lead')->orWhere('type', '=', 'business_submit_lead');
            
            //$q = $this->select('archives.')->where('name','email')->get();
            
        
        $orderby = $orderby ? $orderby : 'contacts.created_at';
        $order = $order ? $order : 'latest';
        if(isset($type) && in_array($type,['archive_lead','contacts_lead','qualified_lead','business_submit_lead','cold_lead','won_lead','lost_lead']))
        {
            $q->where('contacts.type',$type);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('contacts.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }

        if(isset($min) && isset($max))
        {
            $q = $q->whereBetween('ctc',[$min, $max]);
        }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('contacts.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.project_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.mobile_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.primary_country', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.secondary_country', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.requirements', 'LIKE', '%' . $search . '%');
                    
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
