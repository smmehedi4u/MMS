@extends('user.layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between text-gray-700">
                    </div>
                    <section style="background-color: #eee;">
                        <div class="container py-5">

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center ">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                    alt="avatar" class="rounded-circle img-fluid"
                                                    style="width: 150px;margin-left: 80px">
                                            <h5 class="my-3">{{ $user->name }}</h5>
                                            <h5 class="my-3">{{ $user->email }}</h5>
                                            <h5 class="my-3">{{ $user->phone }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-4"">
                                        <div class="card-body">
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
                                                    <div class="card text-white bg-success mt-3 mb-3">
                                                        <div class="card-header">Total Meals</div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $totalMeals }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card text-white bg-success mb-3">
                                                        <div class="card-header">House Expense</div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ number_format($houseExpensePerMember, 2) }} BDT</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card text-white bg-danger mb-3">
                                                        <div class="card-header">Remain Balance</div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ number_format($remainBalance, 2) }} BDT</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ route('teacher.profile.edit') }}"
                            class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                            style="margin-left: 45%;">
                            Edit Profile </a> --}}
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4 shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Market List</h4>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-database-add"></i> ADD
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Accessories</th>
                                    <th>Amount</th>
                                    <th>Marketer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Market</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="market-form" method="post">
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Date</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Accessories</label>
                                        <input type="text" name="accessories" id="accessories" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Expense</label>
                                        <input type="integer" name="amount" id="amount" class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg">
                                        <label>Member</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="">Select Member</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="market-form">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Market</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-form" method="post">
                                <input type="hidden" id="edit-id" name="id">
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Date</label>
                                        <input type="date" name="date" id="edit-date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Accessories</label>
                                        <input type="text" name="accessories" id="edit-accessories" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Expense</label>
                                        <input type="integer" name="amount" id="edit-amount" class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg">
                                        <label>Member</label>
                                        <select name="user_id" class="form-control" id="edit-user_id" required>
                                            <option value="">Select Member</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="edit-form">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "ajax": {
                    "url": "{{ route('profile.getall') }}",
                    "type": "GET",
                    "dataType": "json",
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": function (response) {
                        if (response.status === 200) {
                            return response.market;
                        } else {
                            return [];
                        }
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "date" },
                    { "data": "accessories" },
                    { "data": "amount" },
                    {
                        "data": "user.name",
                        "render": function(data) {
                            return data ? data : "N/A";
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="'+data.id+'" data-date="'+data.date+'"data-accessories="'+data.accessories+'" data-amount="'+data.amount+'" data-user_id="'+data.user_id+'">Edit</a> ' +
                            '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="'+data.id+'">Delete</a>';
                        }
                    }
                ]
            });

            $('#myTable tbody').on('click', '.edit-btn', function () {
                var id = $(this).data('id');
                var date = $(this).data('date');
                var accessories = $(this).data('accessories');
                var amount = $(this).data('amount');
                var user_id = $(this).data('user_id');

                $('#edit-id').val(id);
                $('#edit-date').val(date);
                $('#edit-accessories').val(accessories);
                $('#edit-amount').val(amount);
                $('#edit-user_id').val(user_id);
                $('#editModal').modal('show');
            });


            $('#market-form').submit(function (e) {
                e.preventDefault();
                const marketdata = new FormData(this);

                $.ajax({
                    url: '{{ route('profile.store') }}',
                    method: 'post',
                    data: marketdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            alert("Saved successfully");
                            $('#market-form')[0].reset();
                            $('#exampleModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload();
                        }
                    }
                });
            });

        });


        $('#edit-form').submit(function (e) {
                e.preventDefault();
                const marketdata = new FormData(this);

                $.ajax({
                    url: '{{ route('profile.update') }}',
                    method: 'POST',
                    data: marketdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            alert(response.message);
                            $('#edit-form')[0].reset();
                            $('#editModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');

                if (confirm('Are you sure you want to delete this market?')) {
                    $.ajax({
                        url: '{{ route('profile.delete') }}',
                        type: 'DELETE',
                        data: {id: id},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response); // Debugging: log the response
                            if (response.status === 200) {
                                alert(response.message); // Show success message
                                $('#myTable').DataTable().ajax.reload(); // Reload the table data
                            } else {
                                alert(response.message); // Show error message
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr); // Debugging: log the error
                            alert('Error: ' + error); // Show generic error message
                        }
                    });
                }
            });

    </script>
@endpush
