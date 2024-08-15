<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'client_name',
        'project_name',
        'team_member',
        'project_award_date',
        'document_url',
        'total_amount',
        'milestone_name',
        'milestone_details',
        'percentage_project_amount',
        'totalproject_amount',
        'due_date',
       
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            if ($this->image_type == 'url') {
                return $value;
            } else {
                return url('public/uploads/user/' . $value);
            }
        } else {
            return url('images/default_user.png');
        }
    }

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('projects.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'projects.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('projects.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('projects.due_date',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        // if(isset($milestone)){
        //     $q->where('projects.milestone_name',$milestone);
        // }

        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('projects.client_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('projects.project_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('projects.project_award_date', 'LIKE', '%' . $search . '%');
                    
                   
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    public function invoices()
{
    return $this->hasMany(Invoice::class);
}


}
