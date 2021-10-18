<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcement';

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
