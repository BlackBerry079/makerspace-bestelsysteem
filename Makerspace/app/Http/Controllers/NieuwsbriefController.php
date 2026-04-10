<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Nieuwsbrief;

class NieuwsbriefController extends Controller
{
	public function get(Request $request) {
		return response()->json(Nieuwsbrief::all(), 200);
	}

	public function get_id(Request $request, $id) {
		return Nieuwsbrief::with(['order'])->findOrFail($id);
	}

	public function create(Request $request) {

		$validator = Validator::make($request->all(), [
			"title" => "required|string|max:255",
			"description" => "required|string",
			"type" => "required|in:announcement,stock,error,info",
			"filament_id" => "nullable|integer|exists:filaments,id"
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$nieuwsbrief = new Nieuwsbrief();
		$nieuwsbrief->title = $request->title;
		$nieuwsbrief->description = $request->description;
		$nieuwsbrief->type = $request->type;
		$nieuwsbrief->filament_id = $request->filament_id;
		$nieuwsbrief->save();

		return $nieuwsbrief;
	}

	public function update(Request $request, $id) {

		$validator = Validator::make($request->all(), [
			"title" => "sometimes|string|max:255",
			"description" => "sometimes|string",
			"type" => "sometimes|in:announcement,stock,error,info",
			"filament_id" => "nullable|integer|exists:filaments,id"
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$nieuwsbrief = Nieuwsbrief::findOrFail($id);

		if ($request->has('title')) {
			$nieuwsbrief->title = $request->title;
		}
		if ($request->has('description')) {
			$nieuwsbrief->description = $request->description;
		}
		if ($request->has('type')) {
			$nieuwsbrief->type = $request->type;
		}
		if ($request->has('filament_id')) {
			$nieuwsbrief->filament_id = $request->filament_id;
		}
		$nieuwsbrief->save();

		return $nieuwsbrief;
	}

	public function delete(Request $request, $id) {
		$nieuwsbrief = Nieuwsbrief::findOrFail($id);
		$nieuwsbrief->delete();

		return response()->json(['message' => 'Nieuwsbrief deleted successfully'], 200);
	}
}