<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
public function show($id)
{
    
    // VOORBEELD
    
    // $playlist = DB::table('playlists')->where('id', $id)->first();
    // $songs = DB::table('songs')->where('playlist_id', $id)->get();
    // $playlists = DB::table('playlists')->get();
    
    // return view('playlist', [
    //     'playlist' => $playlist,
    //     'songs' => $songs,
    //     'playlists' => $playlists,
    // ]);
}
    

}
    