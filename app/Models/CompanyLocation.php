<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    use HasFactory;

    protected $table = 'companyLocation';
    public $timestamps = false;
    protected $fillable = ['name','email','phone','company_id'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    
}
