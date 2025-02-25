<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Deposit;
use App\Models\Others;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalDeposit = Deposit::sum('amount');
        $totalMeals = Meal::sum('meal');
        $othersExpenses = Others::sum('expense');

        return view('admin.dashboard', compact('totalDeposit', 'totalMeals', 'othersExpenses'));
    }
}
