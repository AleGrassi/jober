<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageRequirement extends Model
{
    use HasFactory;

    protected $table = 'language_requirement';
    public $timestamps = false;
    protected $fillable = ['name','offer_id'];
    
    public function offer(){
        return $this->belongsTo('App\Models\offer');
    }
}
