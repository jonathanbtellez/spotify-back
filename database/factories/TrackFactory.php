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
            'path' => 'https://res.cloudinary.com/dso0xjfh8/video/upload/v1703969498/default_louxr0.mp3',
        ];
    }

    public function configure(){
		return $this->afterCreating(function (Track $track){
            $album = Album::find($track->album_id);
            if ($album->artist->genre === 'blues') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968137/blues/default.jpg']);
            }

            if ($album->artist->genre === 'gospel') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/gospel/default.jpg']);
            }

            if ($album->artist->genre === 'jazz') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968140/jazz/default.jpg']);
            }

            if ($album->artist->genre === 'metal') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968150/metal/default_tegvtb.jpg']);
            }

            if ($album->artist->genre === 'musica_clasica') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/musica_clasica/default_pdqf08.jpg']);
            }

            if ($album->artist->genre === 'pop') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968131/pop/default_tucahr.jpg']);
            }

            if ($album->artist->genre === 'rock') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968136/rock/default_v9l7pk.jpg']);
            }

            if ($album->artist->genre === 'salsa') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968134/salsa/default_wbgaa4.jpg']);
            }

            if ($album->artist->genre === 'soul') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968141/soul/default_qpl7lu.jpg']);
            }
			$track->image()->save($image);
		});
	}
}
