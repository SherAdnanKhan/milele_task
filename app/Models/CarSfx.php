<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSfx extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'car_model_id'
    ];

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

}
