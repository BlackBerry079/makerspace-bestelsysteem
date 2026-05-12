<?php

namespace App\Http\Controllers;

use illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Filament;

class FilamentController extends Controller
{
	public function get(Request $request) 
	{
		Return response()->json(Filament::all(), 200);
	}

	public function get_id(Request $request, $id) 
	{
		return Filament::with(['category'])->findOrFail($id);
	}

	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			"name" => "required|string|max:255",
			"description" => "nullable|string",
			"amount" => "required|integer|min:0",
			"active" => "required|boolean|default:true",
			"category_id" => "required|integer|exists:filament_category,id"
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$filament = new Filament();
		$filament->name = $request->name;
		$filament->description = $request->description;
		$filament->amount = $request->amount;
		$filament->active = $request->active;
		$filament->category_id = $request->category_id;
		$filament->save();

		return $filament;
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			"name" => "sometimes|string|max:255",
			"description" => "nullable|string",
			"amount" => "sometimes|integer|min:0",
			"active" => "sometimes|boolean",
			"category_id" => "sometimes|integer|exists:filament_category,id"
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$filament = Filament::findOrFail($id);

		if (!isset($filament)) {
			return response()->json(['status' => 0, 'message' => "Filament not found"], 404);
		}

		$filament = new Filament();
		$filament->name = $request->name;
		$filament->description = $request->description;
		$filament->amount = $request->amount;	
		$filament->active = $request->active;
		$filament->category_id = $request->category_id;
		$filament->save();

		return $filament;
	}

	public function delete(Request $request, $id)
	{
		$filament = Filament::findOrFail($id);

		if (!isset($filament)) {
			return response()->json(['status' => 0, 'message' => "Filament not found"], 404);
		}

		$filament->delete();

		return $filament;
	}
}