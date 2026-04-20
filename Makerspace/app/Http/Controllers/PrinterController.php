<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrinterController extends Controller
{
    public function get(Request $request) {
        return response()->json(Printer::all(), 200);
    }

    public function get_id(Request $request, $id) {
        return Printer::with(['order'])->findOrFail($id);
    }

    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'filament_max' => 'required|integer|min:0',
            'status' => 'required|in:beschikbaar,onderhoud,in gebruik',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
        }

        $printer = new Printer();
        $printer->name = $request->name;
        $printer->description = $request->description;
        $printer->filament_max = $request->filament_max;
        $printer->status = $request->status;
        $printer->save();

        return $printer;
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'filament_max' => 'sometimes|integer|min:0',
            'status' => 'sometimes|in:beschikbaar,onderhoud,in gebruik',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
        }

        $printer = Printer::findOrFail($id);

        if (!isset($printer)) {
            return response()->json(['status' => 0, 'message' => "Printer not found"], 404);
        }
        
        $printer->name = $request->name;
        $printer->description = $request->description;
        $printer->filament_max = $request->filament_max;
        $printer->status = $request->status;
        $printer->save();

        return $printer;
    }


    public function delete(Request $request, $id) 
    {
        $printer = Printer::findOrFail($id);

        if (!isset($printer)) {
            return response()->json(['status' => 0, 'message' => "Printer not found"], 404);
        }

        $printer->delete();

        return response()->json(['status' => 1, 'message' => "Printer deleted successfully"], 200);
    }
}