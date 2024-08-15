<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
         'live_enquire_id',
         'email',
         'telephone',
         'ipaddress',
         'activity_path',
         'country',
         'region',
         'city',
         'url',
         'message',
         'created_at',
            
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

    public function getModel($search=null, $orderby=null,$status=null, $order=null,$start_date,$end_date) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('archives.*');
        $orderby = $orderby ? $orderby : 'archives.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('archives.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('archives.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }


        //$candidate = Candidate::whereBetween('ctc',[$min,$max])->get();
        
        
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('archives.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('archives.email', 'LIKE', '%' . $search . '%');
                   
                    
            });
        }
        

        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
