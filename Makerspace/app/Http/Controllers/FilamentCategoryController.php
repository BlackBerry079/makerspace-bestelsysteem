<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FilamentCategory;

class FilamentCategoryController extends Controller
{
	public function get(Request $request) {
		return response()->json(FilamentCategory::all(), 200);
	}

	public function get_id(Request $request, $id) {
		return FilamentCategory::with(['filaments'])->findOrFail($id);
	}
	
	public function create(Request $request) {
		$validator = Validator::make($request->all(), [
			"name" => "required|string|max:255",
			"description" => "nullable|string"
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$filamentCategory = new FilamentCategory();
		$filamentCategory->name = $request->name;
		$filamentCategory->description = $request->description;
		$filamentCategory->save();

		return $filamentCategory;
	}

	public function delete(Request $request, $id) {
		$filamentCategory = FilamentCategory::findOrFail($id);

		if (!isset($filamentCategory)) {
			return response()->json(['status' => 0, 'message' => "Filament category not found"], 404);
		}

		$filamentCategory->delete();

		return $filamentCategory;
	}
}