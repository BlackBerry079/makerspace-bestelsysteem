<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Nieuwsbrief;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function show() {

    $filaments = DB::table('filament')->get();
      return view('voorraad', [
        'filaments' => $filaments,
      ]);
    }
}