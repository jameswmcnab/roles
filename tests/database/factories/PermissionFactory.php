<?php

namespace App\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ultraware\Roles\Models\Permission;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->slug(2),
            'description' => '',
            'model' => $this->faker->words(1, true),
        ];
    }
}
