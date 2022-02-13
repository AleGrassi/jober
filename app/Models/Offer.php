<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offer';
    protected $fillable = ['title','description','location','starting_salary','company_id','education_requirements'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function candidates(){
        return $this->belongsToMany('App\Models\Worker')->withPivot('status');
    }    
    
    public function language_requirements(){
        return $this->hasMany('App\Models\LanguageRequirement');
    }

    public function skill_requirements(){
        return $this->hasMany('App\Models\SkillRequirement');
    }

    public function active_candidates(){
        return DB::select('select * from worker join offer_worker where (offer_id=? and (status=? or status=?))',[$this->id, 'pending', 'rejected']);
    }

    public static $rules = [
        'title' => 'required|string',
        'description' => 'required',
        'location' => 'required',
    ];
}
