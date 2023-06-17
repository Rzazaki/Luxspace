<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'users_id', 'name', 'email', 'address', 'phone', 'courier', 'payment',
        'payment_url', 'total_price', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'users_id', 'id');
    }
}

