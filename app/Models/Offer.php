<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offer';
    protected $fillable = ['title','description','location','starting_salary','company_id','education_requirements'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function candidates(){
        return $this->belongsToMany('App\Models\Worker');
    }    
    
    public function language_requirements(){
        return $this->hasMany('App\Models\LanguageRequirement');
    }

    public function skill_requirements(){
        return $this->hasMany('App\Models\SkillRequirement');
    }

    public static $rules = [
        'title' => 'required|string',
        'description' => 'required',
        'location' => 'required',
    ];
}
