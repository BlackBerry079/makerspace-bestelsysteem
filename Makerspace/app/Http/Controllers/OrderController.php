<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function get(Request $request) 
    {
        return response()->json(Order::all(), 200);
    }

    public function get_id(Request $request, $id) 
    {
        return Order::with(['printer', 'user', 'filaments'])->findOrFail($id);
    }

    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string|max:255',
            'status' => 'required|in:besteld,in productie,voltooid',
            'user_id' => 'required|integer|exists:users,id',
            'printer_id' => 'nullable|integer|exists:printers,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
        }

        $order = new Order();
        $order->title = $request->title;
        $order->description = $request->description;
        $order->file_path = $request->file_path;
        $order->status = $request->status;
        $order->user_id = $request->user_id;
        $order->printer_id = $request->printer_id;
        $order->save();

        return $order;
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string|max:255',
            'status' => 'sometimes|in:besteld,in productie,voltooid',
            'user_id' => 'sometimes|integer|exists:users,id',
            'printer_id' => 'sometimes|integer|exists:printers,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => "Invalid data supplied"], 200);
        }

        $order = Order::findOrFail($id);
        
        if (!$order) {
             return response()->json(['status' => 0, 'message' => "Order not found"], 404);
        }
        
        $order->title = $request->title;
        $order->description = $request->description;
        $order->file_path = $request->file_path;
        $order->status = $request->status;
        $order->user_id = $request->user_id;
        $order->printer_id = $request->printer_id;
        $order->save();

        return $order;
    }

    public function delete(Request $request, $id) 
    {
        $order = Order::findOrFail($id);
        
        if (!$order) {
             return response()->json(['status' => 0, 'message' => "Order not found"], 404);
        }

        $order->delete();

        return response()->json(['status' => 1, 'message' => "Order deleted successfully"], 200);
    }
}
    