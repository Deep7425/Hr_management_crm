<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;
  
    protected $fillable = [
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
        $q = $this->select('project_milestone.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'project_milestone.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('project_milestone.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('project_milestone.due_date',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        // if(isset($milestone)){
        //     $q->where('project_milestone.milestone_name',$milestone);
        // }

        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('project_milestone.client_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('project_milestone.project_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('project_milestone.project_award_date', 'LIKE', '%' . $search . '%');
                    
                   
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    
}
