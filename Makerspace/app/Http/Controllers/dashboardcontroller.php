<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;    

class dashboardController extends Controller{
public function show($id)
{
    $order= DB::table('orders')->where('id', $id)->first();
    $printer=DB::table('printer')->where('id', $id)->get();
    $nieuwsbrief=DB::table('nieuwsbrief')->where('id', $id)->get();

   return view('dashboard', [
            'orders' => $order,
            'printer' => $printer,
            'nieuwsbrief' => $nieuwsbrief,

        ]);
        }
}
    
// functie bedoeld voor de ADMIN
//  public function destroy_nieuwsbrief($id)
//     {
//         DB::table('nieuwsbrief')
//             ->where('id', $id)
//             ->delete();
        
//             return redirect()->back()->with('success', 'Nieuwsbrief verwijderd');
    
//     }

// }
    