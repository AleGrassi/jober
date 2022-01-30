<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    public $timestamps = false;
    protected $fillable = ['name','description','image','email'];

    public function locations(){
        return $this->hasMany('App\Models\CompanyLocation');
    }

    public function offers(){
        return $this->hasMany('App\Models\Offer');
    }
}
