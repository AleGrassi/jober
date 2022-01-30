<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    public $timestamps = false;
    protected $fillable = ['name','worker_id'];

    public function worker() {
        return $this->belongsTo('App\Models\Worker');
    }
}
