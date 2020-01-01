<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'section_id', 'user_id'
    ];

    /**
     * Gets the report section associated with this section template.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function section()
    {
        return $this->hasOne(ReportSection::class);
    }
}
