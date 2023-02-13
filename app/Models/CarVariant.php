<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'car_sfx_id'
    ];

    public function carSFX()
    {
        return $this->belongsTo(CarSFX::class);
    }
}
