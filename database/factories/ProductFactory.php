<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $description = collect($this->faker->sentences())
            ->map(fn ($x) => "<p>$x</p>")
            ->implode('');

        $created_at = Carbon::now()->subMonths(rand(0, 50))->timestamp;

        $images = collect(range(0, rand(5, 10)))
            ->map(
                fn () => $this->faker->imageUrl(400, 400, $category->name . ' beans')
            )->implode(';');

        return [
            'name' => $this->faker->name,
            'price' => rand(10000, 20000),
            'cost' => rand(8000, 9900),
            'weight' => rand(100, 1000),
            'discount' => rand(0, 2000),
            'description' => $description,
            'category_id' => rand(0, 1) == 1 ? $category->id : null,
            'main_image' => $this->faker->imageUrl(400, 400, $category->name . ' beans'),
            'additional_images' => $images,
            'is_ready' => rand(0, 1) == 1,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ];
    }
}
