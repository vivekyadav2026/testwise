<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'certificate_code',
        'course_name',
        'issue_date',
        'score_achieved',
        'is_verified',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
