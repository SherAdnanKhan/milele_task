<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'whole_seller_id', 'steering_type_id', 'car_model_id', 'car_sfx_id', 'car_variant_id', 'color_id', 'month', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function wholeSeller()
    {
        return $this->belongsTo(WholeSeller::class);
    }

    public function steeringType()
    {
        return $this->belongsTo(SteeringType::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function carSFX()
    {
        return $this->belongsTo(CarSFX::class);
    }

    public function carVariant()
    {
        return $this->belongsTo(CarVariant::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
