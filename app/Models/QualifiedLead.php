<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifiedLead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'contacts';
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

    public function getModel($search=null, $orderby=null,$type='contacts_lead', $order=null,$start_date,$end_date) {
        // $q = $this->select('leads.*')->whereIn('user_type', [1]);
        //$q = $this->select('business_leads.*');
        $q = $this->select('contacts.*') 
        ->where('type','=','qualified_lead');
        
        $orderby = $orderby ? $orderby : 'contacts.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('contacts.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('contacts.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('contacts.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.email', 'LIKE', '%' . $search . '%');
                  
                    
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
