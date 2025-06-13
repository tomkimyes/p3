<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Companion extends Model
{
    protected $fillable = [
        'consultation_id',
        'name_kr',
        'phone',
        'email',
        'birthday',
        'gender',
        'name_en',
        'passport_no',
        'passport_expiry',
    ];

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
