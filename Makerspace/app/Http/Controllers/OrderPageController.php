<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPageController extends Controller
{
    public function index()
    {
        $orders = Order::query()->latest()->take(10)->get();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'filament_type' => 'required|string|max:255',
            'kleur_filament' => 'nullable|string|max:255',
            'model_bestand' => 'required|file|extensions:stl,obj,3mf|max:51200',

            'beschrijving' => 'nullable|string',
            'datum' => 'required|date',
        ]);

        $filePath = $request->file('model_bestand')->store('orders', 'public');

        Order::create([
            'title' => 'Bestelling van ' . $validated['naam'] . ' (' . $validated['filament_type'] . ')',
            'description' => $validated['beschrijving'] ?? '',
            'file_path' => $filePath,
            'user_id' => 1,
            'filament_id' => 1,
            'printer_id' => 1,
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Bedankt voor je bestelling! Je aanvraag is ontvangen.');
    }

    public function latestNewsletter()
    {
        $items = DB::table('nieuwsbrief')
            ->select('id', 'title', 'description', 'type', 'created_at')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return response()->json([
            'latest' => $items->first(),
            'items' => $items,
        ]);
    }
}
