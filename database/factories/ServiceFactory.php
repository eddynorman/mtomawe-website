<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->randomNumber(5, true),
            'description' => '<p>'.$this->faker->paragraph().'</p>',
            'is_active' => true,
            'sort_order' => 0,
        ];
    }
}
