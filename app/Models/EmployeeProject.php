<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'team_member',
        
       ];

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('employee_projects.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'employee_projects.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('employee_projects.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('employee_projects.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }

        // if(isset($min) && isset($max))
        // {
        //     $q = $q->whereBetween('ctc',[$min, $max]);
        // }
        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('employee_projects.project_name', 'LIKE', '%' . $search . '%');
                    
            });
        }
        
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
