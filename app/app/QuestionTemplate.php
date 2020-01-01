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
        'question', 'user_id', 'section_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\SectionTemplate');
    }
}
