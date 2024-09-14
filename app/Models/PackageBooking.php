<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tour() {
        return $this->belongsTo(PackageTour::class, 'package_tour_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function bank() {
        return $this->belongsTo(PackageBank::class, 'package_bank_id','id');
    }
}
