<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrinterController extends Controller
{
    // Display all printers
    public function index()
    {
        $printers = Printer::all();
        return view('printer', ['printers' => $printers]);
    }

    // Display single printer details
    public function show($id)
    {
        $printer = Printer::with('orders')->findOrFail($id);
        return view('printer.show', ['printer' => $printer]);
    }

    // Show create printer form
    public function create()
    {
        return view('printer.create');
    }

    // Store printer in database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'filament_max' => 'required|integer|min:1',
            'status' => 'required|in:beschikbaar,onderhoud,in gebruik',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Printer::create([
            'name' => $request->name,
            'description' => $request->description,
            'filament_max' => $request->filament_max,
            'status' => $request->status,
        ]);

        return redirect()->route('printer.index')
            ->with('success', 'Printer created successfully');
    }

    // Show edit printer form
    public function edit($id)
    {
        $printer = Printer::findOrFail($id);
        return view('printer.edit', ['printer' => $printer]);
    }

    // Update printer in database
    public function update(Request $request, $id)
    {
        $printer = Printer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'filament_max' => 'required|integer|min:1',
            'status' => 'required|in:beschikbaar,onderhoud,in gebruik',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $printer->update([
            'name' => $request->name,
            'description' => $request->description,
            'filament_max' => $request->filament_max,
            'status' => $request->status,
        ]);

        return redirect()->route('printer.show', $printer->id)
            ->with('success', 'Printer updated successfully');
    }

    // Delete printer from database
    public function destroy($id)
    {
        $printer = Printer::findOrFail($id);
        $printer->delete();

        return redirect()->route('printer.index')
            ->with('success', 'Printer deleted successfully');
    }
}