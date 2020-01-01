<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'question_id', 'user_id'
    ];

    /**
     * Gets the report question associated with this question template.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function question()
    {
        return $this->hasOne(ReportQuestion::class);
    }
}
