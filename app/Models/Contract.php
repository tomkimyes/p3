<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [
        'consultation_id',
        'product_name',
        'departure_date',
        'return_date',
        'adult_count',
        'child_count',
        'infant_count',
        'adult_price',
        'child_price',
        'infant_price',
        'total_price',
        'is_airfare_included',
        'airfare',
        'land_cost',
        'service_fee',
        'vendor',
        'deposit_amount',
        'deposit_date',
        'deposit_method',
        'middle_payment_amount',
        'middle_payment_date',
        'middle_payment_method',
        'final_payment_amount',
        'final_payment_date',
        'final_payment_method',
    ];

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
