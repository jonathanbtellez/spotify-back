<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use App\Models\Artist;
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
        $idList = 0;

        foreach ($genres as $genre) {

            $playlist = Playlist::where('name', 'like', '%' . $genre->genre . '%')
                ->Where('user_id', Auth::user()->id)
                ->with('image')
                ->limit(6)
                ->get();

            array_push($playlists, ['name' => $genre->genre, 'playlist' => $playlist, 'id' => $idList++]);
        }

        return response()->json($playlists, 200);
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
    public function show(string $id)
    {
        //
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
