<?php

namespace App\Http\Controllers;

use App\Models\Others;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function store(Request $request)
    {
        $otherData = [
            'name' => $request->name,
            'expense' => $request->expense,
            'date' => $request->date
        ];
        Others::create($otherData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getall()
    {
        $other = Others::all();
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'other' => $other
            ]);
        }
        return view('admin.other', compact('other'));
    }

    public function edit($id)
    {
        $other = Others::find($id);
        if ($other) {
            return response()->json([
                'status' => 200,
                'other' => $other
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Other not found'
            ]);
        }
    }

    public function update(Request $request)
    {
        $other = Others::find($request->id);
        if ($other) {
            $other->name = $request->name;
            $other->expense = $request->expense;
            $other->date = $request->date;
            $other->save();

            return response()->json([
                'status' => 200,
                'message' => 'Expense updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Expense not found'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $other = Others::find($request->id);
        if ($other && $other->delete()) {
            return response()->json(['status' => 200, 'message' => 'Expense deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete Expense.']);
        }
    }
}
