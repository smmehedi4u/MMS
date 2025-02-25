<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function store(Request $request)
    {
        $mealData = [
            'user_id' => $request->user_id,
            'meal' => $request->meal,
            'date' => $request->date
        ];
        Meal::create($mealData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getall()
    {
        $meal = Meal::latest()->with('user')->get();
        $users = User::all();
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'meal' => $meal
            ]);
        }
        return view('admin.meal', compact('meal','users'));
    }

    public function edit($id)
    {
        $meal = Meal::find($id);
        if ($meal) {
            return response()->json([
                'status' => 200,
                'meal' => $meal
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Meal not found'
            ]);
        }
    }

    public function update(Request $request)
    {
        $meal = Meal::find($request->id);
        if ($meal) {
            $meal->user_id = $request->user_id;
            $meal->meal = $request->meal;
            $meal->date = $request->date;
            $meal->save();

            return response()->json([
                'status' => 200,
                'message' => 'Meal updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Meal not found'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $meal = Meal::find($request->id);
        if ($meal && $meal->delete()) {
            return response()->json(['status' => 200, 'message' => 'Meal deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete meal.']);
        }
    }
}
