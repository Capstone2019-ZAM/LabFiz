<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'report_id'
    ];

    public function report(){
        return $this->belongsTo(Report::class);
    }
}
