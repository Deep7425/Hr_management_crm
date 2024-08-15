<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDocument extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'candidate_id',
        'aadhar_card',
        'pan_card',
         'bank_account_number',
        'bank_IFSC_code',
        'bank_name',
         'image',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type,$filter,$min,$max,$candidate_id_ajax) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('candidate_documents.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'candidate_documents.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('candidate_documents.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('candidate_documents.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        if(isset($candidate_id_ajax)){
            $q->where('candidate_documents.candidate_id',$candidate_id_ajax);
        }
        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('candidate_documents.aadhar_card', 'LIKE', '%' . $search . '%')
                    ->orWhere('candidate_documents.bank_account_number', 'LIKE', '%' . $search . '%');
                   
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    
}
