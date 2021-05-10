<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $f = $this->faker;
        $name = $f->words(random_int(1, 4), true);
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'price' => random_int(3, 50)*100,
            'image' => $f->imageUrl(),
            'description' => $f->text(500),
        ];
    }
}
