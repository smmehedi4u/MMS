<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{

    public function store(Request $request)
    {
        $depData = [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'date' => $request->date
        ];
        Deposit::create($depData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getall()
    {
        $deposit = Deposit::latest()->with('user')->get();
        $users = User::all();
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'deposit' => $deposit
            ]);
        }
        return view('admin.deposit', compact('deposit','users'));
    }

    public function edit($id)
    {
        $deposit = Deposit::find($id);
        if ($deposit) {
            return response()->json([
                'status' => 200,
                'deposit' => $deposit
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Deposit not found'
            ]);
        }
    }

    public function update(Request $request)
    {
        $deposit = Deposit::find($request->id);
        if ($deposit) {
            $deposit->user_id = $request->user_id;
            $deposit->amount = $request->amount;
            $deposit->date = $request->date;
            $deposit->save();

            return response()->json([
                'status' => 200,
                'message' => 'Deposit updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Deposit not found'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $deposit = Deposit::find($request->id);
        if ($deposit && $deposit->delete()) {
            return response()->json(['status' => 200, 'message' => 'Deposit deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete deposit.']);
        }
    }
} 

