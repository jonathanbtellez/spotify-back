<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    public function userId($user)
    {
        return $this->state([
            'user_id' => $user->id
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
            'name' => fake()->randomElement(['musica_clasica', 'jazz', 'blues', 'gospel', 'soul', 'pop', 'rock', 'metal', 'salsa']) . ' mix',
            'description' => fake()->randomElement([fake()->realText(10), fake()->realText(15), fake()->realText(50)]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Playlist $playlist) {
            $genre = str_replace(' mix', '', $playlist->name);

            for ($i = 0; $i < 20; $i++) {
                $artist = Artist::where('genre', $genre)->with('albums.tracks')->inRandomOrder()->first();
                $album = $artist->albums->random();
                $track = $album->tracks->random();
                $playlist->tracks()->attach($track->id);
            }

            if ($genre === 'blues') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968137/blues/default.jpg']);
            }

            if ($genre === 'gospel') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/gospel/default.jpg']);
            }

            if ($genre === 'jazz') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968140/jazz/default.jpg']);
            }

            if ($genre === 'metal') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968150/metal/default_tegvtb.jpg']);
            }

            if ($genre === 'musica_clasica') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968145/musica_clasica/default_pdqf08.jpg']);
            }

            if ($genre === 'pop') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968131/pop/default_tucahr.jpg']);
            }

            if ($genre === 'rock') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968136/rock/default_v9l7pk.jpg']);
            }

            if ($genre === 'salsa') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968134/salsa/default_wbgaa4.jpg']);
            }

            if ($genre === 'soul') {
                $image = new Image(['path' => 'https://res.cloudinary.com/dso0xjfh8/image/upload/v1703968141/soul/default_qpl7lu.jpg']);
            }
            $playlist->image()->save($image);
        });
    }
}
