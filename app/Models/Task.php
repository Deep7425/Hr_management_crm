<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'task_name',
        'project_id',
        'feature_list_one',
         'feature_list_two',
        'feature_list_three',
        'feature_list_four',
         'srs',
        'test_cases',
        'team_member',
        'task_name',
        'assign_task',
        'status',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type,$project_id_ajax) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('tasks.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'tasks.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('tasks.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('tasks.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        if(isset($project_id_ajax)){
            $q->where('tasks.project_id',$project_id_ajax);
        }
        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('tasks.task_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('tasks.assign_task', 'LIKE', '%' . $search . '%');
                   
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    
}
