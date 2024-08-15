<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class EmailTemplate extends Model
{    
    protected $table  ='email_templates';    
    protected $fillable = [
        'name','slug','subject','description'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    
}
