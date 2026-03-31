<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class dashboard_controller extends Controller
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
    


    
// functie bedoeld voor de ADMIN
 public function destroy_nieuwsbrief($id)
    {
        DB::table('nieuwsbrief')
            ->where('id', $id)
            ->delete();
        
        return redirect('/back');
    }

}
    