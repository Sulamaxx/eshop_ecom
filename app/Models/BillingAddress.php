<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $table = 'billing_addresses';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'city',
        'district',
        'zip',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
