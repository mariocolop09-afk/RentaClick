<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
public function products()
{
    return $this->hasMany(Product::class);
}

public function rentals()
{
    return $this->hasMany(Rental::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}
public function paymentsMade()
{
    return $this->hasMany(Payment::class, 'payer_id');
}

public function paymentsReceived()
{
    return $this->hasMany(Payment::class, 'owner_id');
}

public function reports()
{
    return $this->hasMany(Report::class);
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

public function favorites()
{
    return $this->hasMany(Favorite::class);
}
}
