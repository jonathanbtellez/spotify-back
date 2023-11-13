<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Playlist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'birth_date' => Carbon::now()->subYears(18)->format('Y-m-d'),
            'email_verified_at' => now(),
            'password' => 'a1234567', // password
            'remember_token' => Str::random(20),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(){
		return $this->afterCreating(function (User $user){
			Playlist::factory(10)->userId($user)->create();
            $image = new Image(['path' => 'user/default.jpg']);
			$user->image()->save($image);
		});
	}
}
