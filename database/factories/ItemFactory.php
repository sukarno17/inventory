<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(10000, 500000),
            'quantity' => $this->faker->numberBetween(1, 50),
            'category_id' => 1, // Menghubungkan langsung ke id kategori 1 yang kita buat di setUp()
        ];
    }
}