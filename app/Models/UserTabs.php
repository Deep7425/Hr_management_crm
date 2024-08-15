<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserTabs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        //'image',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'user_type',
        'role',
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

    public function getModel($search=null, $orderby=null, $order=null,$status=null,$start_date,$end_date,$user_type) {
        // $q = $this->select('users.*')->whereIn('user_type', [1]);
        $q = $this->select('users.*')
        ->whereIn('user_type', [$user_type]);
        
        $orderby = $orderby ? $orderby : 'users.created_at';
        $order = $order ? $order : 'desc';
        if(isset($status) && in_array($status,[0,1,2]))
        {
            $q->where('users.status',$status);
        }

        if(isset($start_date) && isset($end_date))
        {
            $q->whereBetween('users.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
        }
       
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('users.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%');
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
