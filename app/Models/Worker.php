<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'worker';
    public $timestamps = false;
    protected $fillable = ['name','surname','image','sex','date_of_birth','email','main_profession','nationality','user_id'];

    public function offers(){
        return $this->belongsToMany('App\Models\Offer')->withPivot('status');
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
/*
    public function isApplied($offer_id){
        return (count($this->offers->where('id',$offer_id)) > 0);
    }
*/
    public function isApplied($offer_id){
        $result = DB::select('select * from offer_worker where (worker_id = ? and offer_id = ? and (status = ? or status = ?))',[$this->id,$offer_id,"rejected","pending"]);
        return (count($result) > 0);
    }

    public static $rules = [
        'name' => 'required|alpha',
        'surname' => 'required|alpha',
        'date_of_birth' => 'date_format:Y-m-d',
        'nationality' => 'required|alpha',
        'main_profession' => 'alpha',
    ];
}
