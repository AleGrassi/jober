<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    public $timestamps = false;
    protected $fillable = ['name','description','image','email','user_id'];

    public function locations(){
        return $this->hasMany('App\Models\CompanyLocation');
    }

    public function offers(){
        return $this->hasMany('App\Models\Offer');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public static $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
}
