<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    protected $fillable = [
        'customer_id',
        'consulted_at',
        'agent',
        'status',
        'referral_path',
        'region',
        'product_name',
        'departure_date',
        'return_date',
        'stay_nights',
        'is_honeymoon',
        'wedding_date',
        'wedding_hall',
        'honeymoon_memo',
        'adult_price',
        'child_price',
        'infant_price',
        'is_airfare_included',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function companions(): HasMany
    {
        return $this->hasMany(Companion::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(ConsultationNote::class);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }
}
