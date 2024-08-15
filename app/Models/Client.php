<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_name',
        'email',
        'client_mobile_number',
        'client_GST_number',
        'primary_country',
        'client_address',
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


    public function getImageAttribute($value)
    {
        if ($value) {
            if ($this->image_type == 'url') {
                return $value;
            } else {
                return url('uploads/user/' . $value);
            }
        } else {
            return url('images/default_user.png');
        }
    }

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type, $request) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('clients.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'clients.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('clients.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('clients.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
        
         if(isset($request->primary_country) && $request->primary_country != ''){
             $q->where('clients.primary_country', 'LIKE', '%' . $request->primary_country . '%');
         }
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('clients.client_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('clients.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('clients.client_mobile_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('clients.client_GST_number', 'LIKE', '%' . $search . '%');
                    
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
