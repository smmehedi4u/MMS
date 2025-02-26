<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marketer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{



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



}
