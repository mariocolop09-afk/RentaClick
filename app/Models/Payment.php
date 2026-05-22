<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'rental_id',
        'payer_id',
        'owner_id',
        'amount',
        'method',
        'status',
        'card_name',
        'card_last4',
        'card_brand',
        'deposit_amount',
        'deposit_status',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
