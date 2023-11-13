<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Image;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    public function artistId($artist){
		return $this->state([
			'artist_id' => $artist->id
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
            'release_date' => fake()->randomElement([
                Carbon::now()->subYears(18)->format('Y-m-d'),
                Carbon::now()->subYears(8)->format('Y-m-d'),
                Carbon::now()->subYears(13)->format('Y-m-d'),
                Carbon::now()->subYears(5)->format('Y-m-d'),
                Carbon::now()->subYears(2)->format('Y-m-d'),
            ]),
        ];
    }

    public function configure(){
		return $this->afterCreating(function (Album $album){
			Track::factory(10)->albumId($album)->create();
            $artist = Artist::find($album->artist_id);
            $image = new Image(['path' => $artist->genre.'/default.jpg']);
			$album->image()->save($image);
		});
	}

}
