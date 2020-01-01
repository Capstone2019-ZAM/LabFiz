<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'report_id', 'user_id'
    ];

    /**
     * Gets the report associated with this report template.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
