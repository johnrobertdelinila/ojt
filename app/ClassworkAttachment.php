<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassworkAttachment extends Model
{
    protected $table = 'classwork_attachments';

    protected $fillable = [
        'id',
        'filename', 
        'classwork_id', 
        'user_id', 
        'agency', 
        'created_at', 
        'updated_at', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function classwork()
    {
        return $this->belongsTo('App\Classwork');
    }
}
