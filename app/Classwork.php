<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classwork extends Model
{
    protected $table = 'classwork';

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function classwork_attachment()
    {
        return $this->hasMany('App\ClassworkAttachment');
    }
}
