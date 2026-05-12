<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\OrderFilaments;
use Illuminate\Support\Facades\Validator;

class OrderFilaments extends Controller
{
	public function get(Request $request) 
	{
		return response()->json(OrderFilaments::all(), 200);
	}

	public function get_id(Request $request, $id) 
	{
		return OrderFilaments::with(['order', 'filament'])->findOrFail($id);
	}

	public function create(Request $request) 
	{
		$validator = Validator::make($request->all(), [
			'order_id' => 'required|integer|exists:orders,id',
			'filament_id' => 'required|integer|exists:filaments,id',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
		}

		$orderFilaments = new OrderFilaments();
		$orderFilaments->order_id = $request->order_id;
		$orderFilaments->filament_id = $request->filament_id;
		$orderFilaments->save();

		return $orderFilaments;
	}

	public function delete(Request $request, $id) 
	{
		$orderFilaments = OrderFilaments::find($id);

		if (!$orderFilaments) {
			return response()->json(['status' => 0, 'message' => "OrderFilaments not found"], 404);
		}

		$orderFilaments->delete();

		return response()->json(['status' => 1, 'message' => "OrderFilaments deleted successfully"], 200);
	}
}