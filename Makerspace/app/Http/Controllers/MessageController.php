<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MessageController extends Controller
{
public function show($id)
{
     $nieuwsbrief = DB::table('nieuwsbrief')->where('id',$id)->get();
    
    return view('nieuwsbrief',[
        'nieuwsbrief' => $nieuwsbrief
        ]);
}

public function create_nieuwsbrief(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'type' => 'required',

    ]);
    
    // 
    DB::table('nieuwsbrief')->insert([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'type' => $request->input('type'),
    ]);

    return redirect('/');



}
            

    public function delete_nieuwsbrief($id)
    {
        DB::table('nieuwsbrief')
            ->where('id', $id)
            ->delete();
        
        return (redirect('/'));
    }
}
   