<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Color;
use App\Models\CarSFX;
use App\Models\CarModel;
use App\Models\Supplier;
use App\Models\CarVariant;
use App\Models\WholeSeller;
use App\Models\SteeringType;
use Illuminate\Http\Request;

class FilterController extends Controller
{
     /**
     * Get the filter page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $steeringTypes = SteeringType::select('id', 'name')->get();
        $whole_sellers = [];
        $steering_types = [];
        $car_models = [];
        $car_sfxs = [];
        $car_variants = [];
        $colors = [];

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return view('filter', compact('suppliers', 'whole_sellers', 'steeringTypes', 'car_models', 'car_sfxs', 'car_variants', 'colors', 'months'));
    }
    /**
     * Get the whole sellers for a supplier.
     *
     * @param int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function getWholeSellers($supplier_id)
    {
        $wholeSellers = WholeSeller::where('supplier_id', $supplier_id)->pluck('name', 'id');
        return response()->json($wholeSellers);
    }

    /**
     * Get the steering types for a whole seller.
     *
     * @param int $whole_seller_id
     * @return \Illuminate\Http\Response
     */
    public function getSteeringTypes($whole_seller_id)
    {
        $steeringTypes = SteeringType::where('whole_seller_id', $whole_seller_id)->pluck('name', 'id');
        return response()->json($steeringTypes);
    }

    /**
     * Get the car models for a steering type.
     *
     * @param int $steering_type_id
     * @return \Illuminate\Http\Response
     */
    public function getCarModels($steering_type_id)
    {
        $carModels = CarModel::where('steering_type_id', $steering_type_id)->pluck('name', 'id');
        return response()->json($carModels);
    }

    /**
     * Get the car SFXs for a car model.
     *
     * @param int $car_model_id
     * @return \Illuminate\Http\Response
     */
    public function getCarSFXs($car_model_id)
    {
        $carSFXs = CarSFX::where('car_model_id', $car_model_id)->pluck('name', 'id');
        return response()->json($carSFXs);
    }

    /**
     * Get the car variants for a car model.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCarVariants(Request $request)
    {
        $carVariants = CarVariant::where('car_sfx_id', $request->car_sfx)->select('id', 'name')->get();
        return response()->json($carVariants);
    }

    /**
     * Get the car color for a car model.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getColor(Request $request)
    {
        $colors = Color::where('car_variant_id', $request->car_variant)
            ->select('name', 'id')->get();
        return response()->json($colors);
    }

    /**
     * filter the data.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFilteredData(Request $request)
    {
        $data = Car::where('supplier_id', $request->supplier)
        ->where('whole_seller_id', $request->whole_seller)
        ->where('steering_type_id', $request->steering_type)
        ->where('car_model_id', $request->car_model)
        ->where('car_sfx_id', $request->car_sfx)
        ->where('car_variant_id', $request->car_variant)
        ->where('color_id', $request->color)
        ->get();

        return response()->json($data);
    }

    /**
     * Save the table.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveTableData(Request $request)
    {
        $tableData = $request->get('tableData');
        // Loop through the table data and save to the database
        foreach ($tableData as $rowData) {
            $car = Car::find($rowData['id']);
            if ($car) {
                // Update the existing car with the new data
                $car->jan = $rowData['jan'] ?: 0;
                $car->feb = $rowData['feb'] ?: 0;
                $car->mar = $rowData['mar'] ?: 0;
                $car->apr = $rowData['apr'] ?: 0;
                $car->may = $rowData['may'] ?: 0;
                $car->jun = $rowData['jun'] ?: 0;
                $car->jul = $rowData['jul'] ?: 0;
                $car->aug = $rowData['aug'] ?: 0;
                $car->sep = $rowData['sep'] ?: 0;
                $car->oct = $rowData['oct'] ?: 0;
                $car->nov = $rowData['nov'] ?: 0;
                $car->dec = $rowData['dec'] ?: 0;
                $car->save();
            } else {
                // Create a new car with the table data
                $car = new Car();
                $car->supplier_id = $rowData['supplier_id'];
                $car->whole_seller_id = $rowData['whole_seller_id'];
                $car->steering_type_id = $rowData['steering_type_id'];
                $car->car_model_id = $rowData['car_model_id'];
                $car->car_sfx_id = $rowData['car_sfx_id'];
                $car->car_variant_id = $rowData['car_variant_id'];
                $car->color_id = $rowData['color_id'];
                $car->jan = $rowData['jan'] ?: 0;
                $car->feb = $rowData['feb'] ?: 0;
                $car->mar = $rowData['mar'] ?: 0;
                $car->apr = $rowData['apr'] ?: 0;
                $car->may = $rowData['may'] ?: 0;
                $car->jun = $rowData['jun'] ?: 0;
                $car->jul = $rowData['jul'] ?: 0;
                $car->aug = $rowData['aug'] ?: 0;
                $car->sep = $rowData['sep'] ?: 0;
                $car->oct = $rowData['oct'] ?: 0;
                $car->nov = $rowData['nov'] ?: 0;
                $car->dec = $rowData['dec'] ?: 0;
                $car->save();
            }
        }   
        $data = Car::where('supplier_id', $tableData[0]['supplier_id'])
        ->where('whole_seller_id', $tableData[0]['whole_seller_id'])
        ->where('steering_type_id', $tableData[0]['steering_type_id'])
        ->where('car_model_id', $tableData[0]['car_model_id'])
        ->where('car_sfx_id', $tableData[0]['car_sfx_id'])
        ->where('car_variant_id', $tableData[0]['car_variant_id'])
        ->where('color_id', $tableData[0]['color_id'])
        ->get();
        return response()->json($data);
    }

}