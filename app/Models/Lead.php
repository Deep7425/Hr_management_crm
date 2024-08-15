<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type) {
        // $q = $this->select('leads.*')->whereIn('user_type', [1]);
        $q = $this->select('leads.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'leads.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('leads.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('leads.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('leads.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('leads.email', 'LIKE', '%' . $search . '%');
                  
                    
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
