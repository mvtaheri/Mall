<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name'=>$this->faker->word,
            'code'=>$this->faker->numberBetween(),
            'price'=>$this->faker->randomFloat(0,100,2000),
            'vendor_id'=>1,
            'stock'=>$this->faker->numberBetween(0,10)
        ];
    }
}
