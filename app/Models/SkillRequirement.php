<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillRequirement extends Model
{
    use HasFactory;

    protected $table = 'skill_requirement';
    public $timestamps = false;
    protected $fillable = ['name','offer_id'];

    public function offer(){
        return $this->belongsTo('App\Models\Offer');
    }
}
