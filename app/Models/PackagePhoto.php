<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePhoto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tour(){
        return $this->belongsTo(PackageTour::class, 'package_tour_id', 'id');
    }
}
