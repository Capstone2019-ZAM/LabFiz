<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportQuestion extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'report_section_id', 'report_question_template_id', 'answer','description'
    ];

    public function section(){
        return $this->belongsTo(ReportSection::class);
    }
}
