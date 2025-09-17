<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'price' => fake()->numberBetween(10000, 100000),
            'cover_event' => fake()->imageUrl(640, 480, 'events'),
            'address' => fake()->address(),
            'map_url' => fake()->url(),
            'gform_url' => fake()->url(),
            'start_time' => $startTime = fake()->time('H:i'),
            'end_time' => date('H:i', strtotime($startTime) + fake()->numberBetween(3600, 86400)), // Add 1 to 24 hours
            'duration_days' => fake()->numberBetween(1, 7),
            'participants' => fake()->numberBetween(1, 100),
            'type' => fake()->randomElement(['rkt', 'non-rkt']),
            'division' => fake()->randomElement(['general', 'programming', 'multimedia', 'networking']),
            'start_date'=> Carbon::now()->subDays(fake()->numberBetween(1, 5))->addDays(fake()->numberBetween(0, 10))
        ];
    }
}
