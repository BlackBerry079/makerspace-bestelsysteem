<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function show($id = null)
    {
        if ($id !== null) {
            $order = DB::table('orders')->where('id', $id)->get();
            $printer = DB::table('printer')->where('id', $id)->get();
            $nieuwsbrief = DB::table('nieuwsbrief')->where('id', $id)->get();
            $active_printer = DB::table('printer')->where('status', 'beschikbaar')->get(); // printers die actief zijn
            // filament beschikbaar
             $active_voorraad_filaments = DB::table('filament')->where('active', 'beschikbaar')->get(); // voorraad die actief is
        
        } else {
            $order = DB::table('order')->orderBy('created_at', 'desc')->get();
            $printer = DB::table('printer')->get();
            $nieuwsbrief = DB::table('nieuwsbrief')->get();
            $active_printer = DB::table('printer')->where('status', 'beschikbaar')->get(); // printers die actief zijn
            $active_voorraad_filaments = DB::table('filament')->where('active', '1')->get(); // voorraad die actief is
        }
        
        

        $voorraad = DB::table('filament')->get();

        return view('dashboard', [
            'orders' => $order,
            'printer' => $printer,
            'active_printer' => $active_printer,
            'active_voorraad_filaments' => $active_voorraad_filaments,
            'nieuwsbrief' => $nieuwsbrief,
            'voorraad' => $voorraad,
        ]);
    }
}