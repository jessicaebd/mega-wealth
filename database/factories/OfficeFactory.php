<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficeFactory extends Factory
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
            'name' => $this->faker->company() . ' Office',
            'address' => $this->faker->streetAddress() . ', ' . $this->faker->countryCode(),
            'contact_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'image' => 'default.jpg'
        ];
    }
}
