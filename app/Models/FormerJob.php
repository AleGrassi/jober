<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormerJob extends Model
{
    use HasFactory;

    protected $table = 'formerJob';
    public $timestamps = false;
    protected $fillable = ['name','worker_id'];

    public function worker(){
        return $this->belongsTo('App\Models\Worker');
    }
}
