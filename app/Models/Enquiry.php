<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $table = 'enquiry';
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
        'ipaddress',
        'activity_path',
        'country',
        'region',
        'city',
        'url',
        'message',
            
    ];

    // public function getImageAttribute($value)
    // {
    //     if ($value) {
    //         if ($this->image_type == 'url') {
    //             return $value;
    //         } else {
    //             return url('public/' . $value);
    //         }
    //     } else {
    //         return url('images/default_user.png');
    //     }
    // }

    public function getModel($search=null, $orderby=null,$type=null, $order=null,$start_date,$end_date) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('enquiries.*');
        $orderby = $orderby ? $orderby : 'enquiries.created_at';
        $order = $order ? $order : 'desc';

        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('enquiries.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('enquiries.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }

        // if(isset($enquiry)){
        //     $enquiry = Enquiry::limit(5)->offset(1)->get();
            
        // }

        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('enquiries.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('enquiries.email', 'LIKE', '%' . $search . '%');
                   
                    
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    
}
