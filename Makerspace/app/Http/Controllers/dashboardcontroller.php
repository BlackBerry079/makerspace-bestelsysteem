<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function show($id = null)
    {
        if ($id !== null) {
            $order = DB::table('orders')->where('id', $id)->first();
            $printer = DB::table('printer')->where('id', $id)->get();
            $nieuwsbrief = DB::table('nieuwsbrief')->where('id', $id)->get();
        } else {
            $order = DB::table('orders')->orderBy('created_at', 'desc')->get();
            $printer = DB::table('printer')->get();
            $nieuwsbrief = DB::table('nieuwsbrief')->get();
        }

        return view('dashboard', [
            'orders' => $order,
            'printer' => $printer,
            'nieuwsbrief' => $nieuwsbrief,
        ]);
    }
}