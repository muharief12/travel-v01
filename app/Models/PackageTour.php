<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function bookings(){
        return $this->hasMany(PackageBooking::class, 'package_tour_id');
    }

    public function photos(){
        return $this->hasMany(PackagePhoto::class, 'package_tour_id');
    }
}
