<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Color;
use App\Models\CarSfx;
use App\Models\CarModel;
use App\Models\Supplier;
use App\Models\CarVariant;
use App\Models\WholeSeller;
use App\Models\SteeringType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // Create suppliers
      $supplier1 = Supplier::create(['name' => 'Supplier One']);
      $supplier2 = Supplier::create(['name' => 'Supplier Two']);
      $supplier3 = Supplier::create(['name' => 'Supplier Three']);

      // Create whole sellers
      $wholeSeller1 = WholeSeller::create(['name' => 'Whole Seller One', 'supplier_id' => $supplier1->id]);
      $wholeSeller2 = WholeSeller::create(['name' => 'Whole Seller Two', 'supplier_id' => $supplier2->id]);
      $wholeSeller3 = WholeSeller::create(['name' => 'Whole Seller Three', 'supplier_id' => $supplier3->id]);

      // Create steering types
      $steeringType1 = SteeringType::create(['name' => 'Left Hand Driven (LHD)']);
      $steeringType2 = SteeringType::create(['name' => 'Right Hand Driven (RHD)']);

      // Create car models
      $model1 = CarModel::create(['name' => 'Model One', 'steering_type_id' => $steeringType1->id]);
      $model2 = CarModel::create(['name' => 'Model Two', 'steering_type_id' => $steeringType2->id]);

      // Create car sfxs
      $sfx1 = CarSfx::create([
          'name' => 'A1',
          'car_model_id' => $model1->id,
      ]);
      $sfx2 = CarSFX::create([
          'name' => 'B1',
          'car_model_id' => $model1->id,
      ]);
      $sfx3 = CarSFX::create([
          'name' => 'A1',
          'car_model_id' => $model2->id,
      ]);

      // Create car variants
      $variant1 = CarVariant::create([
          'name' => 'SomeCar_1',
          'car_sfx_id' => $sfx1->id,
      ]);
      $variant2 = CarVariant::create([
          'name' => 'SomeCar_2',
          'car_sfx_id' => $sfx2->id,
      ]);
      $variant3 = CarVariant::create([
          'name' => 'SomeCar_1',
          'car_sfx_id' => $sfx3->id,
      ]);

      // Create colors
      $color1 = Color::create([
          'name' => 'Black',
          'car_variant_id' => $variant1->id,
      ]);
      $color2 = Color::create([
          'name' => 'White',
          'car_variant_id' => $variant2->id,
      ]);
      $color3 = Color::create([
          'name' => 'Blue',
          'car_variant_id' => $variant3->id,
      ]);
    }
}
