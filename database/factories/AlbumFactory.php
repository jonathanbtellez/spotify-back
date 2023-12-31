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
    public function artistId($artist)
    {
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

    public function configure()
    {
        return $this->afterCreating(function (Album $album) {
            Track::factory(10)->albumId($album)->create();
            $artist = Artist::find($album->artist_id);
            if ($artist->genre === 'blues') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968137/blues/default.jpg']);
            }

            if ($artist->genre === 'gospel') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/gospel/default.jpg']);
            }

            if ($artist->genre === 'jazz') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968140/jazz/default.jpg']);
            }

            if ($artist->genre === 'metal') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968150/metal/default_tegvtb.jpg']);
            }

            if ($artist->genre === 'musica_clasica') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/musica_clasica/default_pdqf08.jpg']);
            }

            if ($artist->genre === 'pop') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968131/pop/default_tucahr.jpg']);
            }

            if ($artist->genre === 'rock') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968136/rock/default_v9l7pk.jpg']);
            }

            if ($artist->genre === 'salsa') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968134/salsa/default_wbgaa4.jpg']);
            }

            if ($artist->genre === 'soul') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968141/soul/default_qpl7lu.jpg']);
            }
            

            $album->image()->save($image);
        });
    }
}
