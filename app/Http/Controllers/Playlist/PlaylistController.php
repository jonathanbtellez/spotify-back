<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = [];
        $genres  = DB::select('select distinct genre from artists');
        $lastPlaylist = Playlist::where('user_id', Auth::user()->id)
            ->with('image')
            ->limit(6)
            ->get();

        foreach ($genres as $genre) {


            $playlist = Playlist::where('name', 'like', '%' . $genre->genre . '%')
                ->Where('user_id', Auth::user()->id)
                ->with('image')
                ->limit(6)
                ->get();


            array_push($playlists, ['name' => $genre->genre, 'playlist' => $playlist, 'id' => uuid_create()]);
        }

        return response()->json([
            'playlist' => $playlists,
            'lastPlaylist' => $lastPlaylist
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return response()->json($playlist->load('tracks.image','tracks.album.artist', 'image'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
