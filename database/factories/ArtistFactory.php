<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
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
            'genre' => fake()->randomElement(['musica_clasica', 'jazz', 'blues', 'gospel','soul','pop','rock','metal','salsa'])
        ];
    }

    public function configure(){
		return $this->afterCreating(function (Artist $artist){
			Album::factory(8)->artistId($artist)->create();
            $image = new Image(['path' => 'user/default.jpg']);
			$artist->image()->save($image);
		});
	}
}