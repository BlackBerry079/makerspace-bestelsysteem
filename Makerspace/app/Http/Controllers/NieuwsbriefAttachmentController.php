<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NieuwsbriefAttachment;

class NieuwsbriefAttachmentController extends Controller
{
	public function get(Request $request) {
		return response()->json(NieuwsbriefAttachment::all(), 200);
	}

	public function get_id(Request $request, $id) {
		return NieuwsbriefAttachment::with(['nieuwsbrief'])->findOrFail($id);
	}

	public function create(Request $request) {

		$validator = Validator::make($request->all(), [
			"nieuwsbrief_id" => "required|integer|exists:nieuwsbrief,id",
			"path" => "required|string|max:255",
		]);
		
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$attachment = new NieuwsbriefAttachment();
		$attachment->nieuwsbrief_id = $request->nieuwsbrief_id;
		$attachment->path = $request->path;
		$attachment->save();

		return $attachment;
	}

	public function delete(Request $request, $id) {
		$attachment = NieuwsbriefAttachment::findOrFail($id);
		$attachment->delete();
		
		return response()->json(['status' => 1, 'message' => "Attachment deleted"], 200);
	}
}