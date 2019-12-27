<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question'
    ];

    public function report_section(){
        return $this->belongsTo(ReportSection::class);
    }
}
