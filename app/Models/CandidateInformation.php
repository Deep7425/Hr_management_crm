<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateInformation extends Model
{
    use HasFactory;
    //protected $table = 'candidate_information';
    protected $fillable = [
        'candidate_id',
        'candidate_documents_id',
        'school_university_name',
         'passout_year',
        'percentage',
        'status',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type,$filter,$min,$max,$information_id_ajax) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        //die($information_id_ajax);
        $q = $this->select('candidate_information.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'candidate_information.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('candidate_information.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('candidate_information.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        //dd($candidate_id_ajax);
        if(isset($information_id_ajax)){
            $q->where('candidate_information.candidate_id',$information_id_ajax);
           
        }
        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('candidate_information.school_university_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidate_information.passout_year', 'LIKE', '%' . $search . '%');
                   
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    
}
