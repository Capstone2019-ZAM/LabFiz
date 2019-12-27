<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','user_id','room', 'assigned_to', 'status', 'severity', 'description', 'comments'
    ];
}
