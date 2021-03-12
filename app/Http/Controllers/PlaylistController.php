<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Playlist;


class PlaylistController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        return Playlist::create($data);
    }

    public function getPlaylist(Request $request,$id)
    {
        $playlist = Playlist::find($id);
        $playlist->courses;
        return response()->json($playlist,200);
    }
}