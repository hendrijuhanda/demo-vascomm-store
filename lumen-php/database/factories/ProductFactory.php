<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Entities\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(25),
            'price' => $this->faker->randomFloat(2, 10000, 5000000),
            'image' => $this->faker->randomElement(['/product-1.png', 'product-2.png']),
            'is_active' => $this->faker->boolean(75)
        ];
    }
}
