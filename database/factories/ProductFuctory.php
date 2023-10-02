<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->realText(10),
            'price'=>$this->faker->numberBetween($min=500,$max=10000),
            'maker'=>$this->faker->realText(10),
            'size'=>$this->faker->realText(10),
            'category'=>$this->faker->numberBetween($min=1,$max=3),
            'detail'=>$this->faker->realText(20),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>null,
        ];
    }
}
