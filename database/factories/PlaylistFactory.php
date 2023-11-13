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
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Playlist $playlist) {
            $genre = str_replace(' mix', '', $playlist->name);

            for($i = 0; $i < 20; $i++){
                $artist = Artist::where('genre', $genre)->with('albums.tracks')->inRandomOrder()->first();
                $album = $artist->albums->random();
                $track = $album->tracks->random();
                $playlist->tracks()->attach($track->id);
            }

            $image = new Image(['path' => $genre . '/default.jpg']);
            $playlist->image()->save($image);
        });
    }
}
