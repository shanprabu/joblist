<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}