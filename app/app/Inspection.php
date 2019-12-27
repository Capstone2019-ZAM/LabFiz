<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room','assigned_to', 'user_id', 'due_date', 'report_id', 'status'
    ];
}
