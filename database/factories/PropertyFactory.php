<?php

namespace Database\Factories;

use App\Models\BuildingType;
use Illuminate\Support\Str;

use App\Models\PropertyStatus;
use App\Models\SalesType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'location' => $this->faker->streetAddress() . ', ' . $this->faker->countryCode(),
            'price' => rand(1, 99) * 10000,
            'image' => 'default.jpg',
            'property_status_id' => 1,
            'building_type_id' => 1,
            'sales_type_id' => 1
        ];
    }

    public function randPropertyStatus()
    {
        return $this->state(function (array $attributes) {
            return [
                'property_status_id' => PropertyStatus::all()->random(),
            ];
        });
    }

    public function randBuildingType()
    {
        return $this->state(function (array $attributes) {
            return [
                'building_type_id' => BuildingType::all()->random(),
            ];
        });
    }

    public function randSalesType()
    {
        return $this->state(function (array $attributes) {
            $salesType = SalesType::all()->random();
    
            if ($salesType->name == 'rent') {
                $price = rand(10, 199) * 10;
            } else {
                $price = rand(1, 99) * 10000;
            }
            
            return [
                'sales_type_id' => $salesType,
                'price' => $price
            ];
        });
    }
}
