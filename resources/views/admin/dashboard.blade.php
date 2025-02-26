@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-success mt-3 mb-3">
                    <div class="card-header">Total Deposit</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($totalDeposit, 2) }} BDT</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-info mt-3 mb-3">
                    <div class="card-header">Total Meals</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalMeals }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Market Expenses</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($marketExpenses, 2) }} BDT</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">House Expenses</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($othersExpenses, 2) }} BDT</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
