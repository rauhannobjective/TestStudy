<?php

namespace Database\Factories\Entities;

use App\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->domainName(),
            'value' => $this->faker->randomFloat(2, 100, 1000)
        ];
    }
}
