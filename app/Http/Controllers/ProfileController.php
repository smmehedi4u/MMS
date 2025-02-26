<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use App\Models\Others;
use App\Models\Deposit;
use App\Models\Marketer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
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
        $userId = Auth::id();
        $user = auth()->user();

        $month = now()->format('Y-m');

        $market = Marketer::where('user_id', $userId)->latest()->with('user')->get();
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'market' => $market
            ]);
        }

        $totalDeposit = Deposit::where('user_id', $userId)->where('date', 'like', "$month%")->sum('amount');
        $totalMeals = Meal::where('user_id', $userId)->where('date', 'like', "$month%")->sum('meal');
        $marketExpenses = Marketer::sum('amount');
        $mealRates = $totalMeals > 0 ? round($marketExpenses / $totalMeals, 2) : 0;
        $houseExpenses = Others::where('date', 'like', "$month%")->sum('expense');
        $totalMembers = User::count();
        $houseExpensePerMember = $totalMembers > 0 ? round($houseExpenses / $totalMembers, 2) : 0;
        $mealsExpense = ($totalMeals * $mealRates);
        $remainBalance = ($totalDeposit - ($mealsExpense + $houseExpensePerMember));


        return view('user.profile', compact('user','market', 'totalDeposit', 'totalMeals', 'houseExpensePerMember', 'remainBalance'));

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
