<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentEmployee extends Model
{
    use HasFactory;
     
    protected $fillable = [
     'employee_name',
     'employee_code',
     'employee_department',
     'primarySkill',
     'secondarySkill',
     'employee_technology',
     'primary_contact_number',
     'date_of_joining',
     'date_of_birth',
     'official_email_address',
     'aadhar_number',
     'document',
     'personal_email_address',
     'emergency_contact_number',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type, $filter ,$min,$max,$employee_name) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('current_employees.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'current_employees.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[1,2,3,4,5]))
        {
            $q->where('current_employees.status',$status);
            // $q = $this->select('status.*')
            // ->where('status', '!=', 'working')
            // ->where('status', '!=', 'left')
            // ->where('status', '!=', 'will_join')
            // ->where('status', '!=', 'absent')
            // ->where('status', '!=', 'under_discussion');
            
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('current_employees.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }

        if(isset($employee_name))
        {
            $q->where('current_employees.employee_name', 'LIKE', '%' . $employee_name . '%');
        }

        if(isset($min) && isset($max))
        {
            $q = $q->whereBetween('ctc',[$min, $max]);
        }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('current_employees.employee_name', 'LIKE', '%' . $search . '%')
                ->orWhere('current_employees.employee_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.employee_department', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.primarySkill', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.secondarySkill', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.employee_technology', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.date_of_joining', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.date_of_birth', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.official_email_address', 'LIKE', '%' . $search . '%')
                    ->orWhere('current_employees.aadhar_number', 'LIKE', '%' . $search . '%');
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
