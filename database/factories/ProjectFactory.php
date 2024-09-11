<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::get();
        return [
            'name' => fake()->unique()->text(50),
            'description' => fake()->unique()->sentence(),
            'user_id' => $users[random_int(0, ($users->count()-1))]->id,
            'start_date' => fake()->dateTimeBetween(startDate: 'now', endDate: '+1 years'),
            'end_date' => fake()->dateTimeBetween(startDate: 'now', endDate: '+1 years'),
        ];
    }
}
