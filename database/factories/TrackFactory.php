<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Image;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{

    public function albumId($album){
		return $this->state([
			'album_id' => $album->id
		]);
	 }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([fake()->realText(10), fake()->firstName(), fake()->realText(15), fake()->realText(20)]),
            'duration' => fake()->randomElement(['4:29','3:29','5:10','2:50','5:55','4:32']),
            'path' => '/storage/tracks/default.mp3',
        ];
    }

    public function configure(){
		return $this->afterCreating(function (Track $track){
            $album = Album::find($track->album_id);
            $image = new Image(['path' => $album->artist->genre.'/default.jpg']);
			$track->image()->save($image);
		});
	}
}
