<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
public function show()
{
     $printer = DB::table('printer')->get();
    
    return view('printer',[
        'printer' => $printer
        ]);
}

public function create_printer(Request $request)
{
    $request->validate([
        'name' => 'required',
        'merk' => 'required',
        'beschrijving' => 'nullable',
    ]);
    
    // 
    DB::table('printer')->insert([
        'name' => $request->input('name'),
        'brand' => $request->input('merk'),
        'description' => $request->input('beschrijving'),
    ]);

    return redirect('/');



}
            

    public function delete_printer($id)
    {
        DB::table('printer')
            ->where('id', $id)
            ->delete();
        
        return (redirect('/dashboard'));
    }
}
   