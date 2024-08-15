<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'primary_mobile_number',
        'years_of_experience',
        //'image',
        'primarySkills',
        'secondarySkills',
        'currentCompany',
        'lastCompany',
        'remark',
        'ctc',
        'ectc',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type, $filter ,$min,$max) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('candidates.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'candidates.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('candidates.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('candidates.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }

        if(isset($min) && isset($max))
        {
            $q = $q->whereBetween('ctc',[$min, $max]);
        }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('candidates.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidates.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidates.notice_period', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidates.primarySkills', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidates.ctc', 'LIKE', '%' . $search . '%');
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
