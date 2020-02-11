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
        'title', 'report_id', 'report_section_template_id'
    ];

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function questions(){
        return $this->hasMany(ReportQuestion::class);
    }
}
