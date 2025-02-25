<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marketer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request
        $markData = [
            'date' => $request->date,
            'accessories' => $request->accessories,
            'amount' => $request->amount,
            'user_id' => Auth::id(),
        ];
        Marketer::create($markData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getall()
    {
        $market = Marketer::latest()->with('user')->get();
        $users = User::all();
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'market' => $market
            ]);
        }
        return view('user.market', compact('market','users'));
    }

    public function edit($id)
    {
        $task = Marketer::find($id);
        if ($task) {
            return response()->json([
                'status' => 200,
                'task' => $task
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Marketer not found'
            ]);
        }
    }

    /**
     * Update a task via AJAX.
     */
    public function update(Request $request)
    {
        $task = Marketer::find($request->id);
        if ($task) {
            $task->date = $request->date;
            $task->accessories = $request->accessories;
            $task->amount = $request->amount;
            $task->user_id = Auth::id();
            $task->save();
            return response()->json([
                'status' => 200,
                'message' => 'Market updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Market not found'
            ]);
        }
    }

    /**
     * Delete a task via AJAX.
     */
    public function delete(Request $request)
    {
        $task = Marketer::find($request->id);
        if ($task && $task->delete()) {
            return response()->json(['status' => 200, 'message' => 'Market deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete Market.']);
        }
    }

}
