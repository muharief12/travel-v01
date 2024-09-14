<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bookings() {
        return $this->hasMany(PackageBooking::class, 'package_bank_id');
    }
}
