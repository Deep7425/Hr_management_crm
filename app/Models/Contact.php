<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Contact extends Model
{
    use HasFactory;

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

    public function getBaScreenshotAttribute($value)
    {
        if ($value) {
            if ($this->image_type == 'url') {
                return $value;
            } else {
                return url('uploads/user/' . $value);
            }
        } else {
            return url('images/default_user.png');
        }
    }

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type, $filter ,$min,$max) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        
       
        $login_user_data = auth()->user();
        if($login_user_data->user_type != 1){
        $q = $this->select('contacts.*')->where('lead_source','ajaysir');
        // ->whereIn('status', [$status]);
        }else if($login_user_data->user_type == 7){
            $q = $this->select('contacts.*')->where('lead_source','extract'); 
        }else{
        
            $q = $this->select('contacts.*')
               ->whereIn('user_type', [$user_type]); 
        }
        
        $orderby = $orderby ? $orderby : 'contacts.created_at';
        $order = $order ? $order : 'latest';
        if(isset($status) && in_array($status,['ajaysir','extract']))
        {
            $q->where('contacts.lead_source',$status);
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
