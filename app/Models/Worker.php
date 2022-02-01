<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'worker';
    public $timestamps = false;
    protected $fillable = ['name','surname','image','sex','date_of_birth','email','main_profession','nationality','user_id'];

    public function offers(){
        return $this->belongsToMany('App\Models\Offer');
    }

    public function educations(){
        return $this->hasMany('App\Models\Education');
    }

    public function skills(){
        return $this->hasMany('App\Models\Skill');
    }
    
    public function languages(){
        return $this->hasMany('App\Models\Language');
    }

    public function former_jobs(){
        return $this->hasMany('App\Models\FormerJob');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
