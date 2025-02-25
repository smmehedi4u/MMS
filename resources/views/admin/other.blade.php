@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4 shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Others Expense List</h4>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-database-add"></i> ADD
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Expenses</th>
                                    <th>Date</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Extra Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="other-form" method="post">

                                <div class="row">
                                    <div class="col-lg">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Expense</label>
                                        <input type="integer" name="expense" id="expense" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Date</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="other-form">Save</button>
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
                            <h5 class="modal-title" id="editModalLabel">Edit Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-form" method="post">
                                <input type="hidden" id="edit-id" name="id">
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Name</label>
                                        <input type="text" name="name" id="edit-name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Expense</label>
                                        <input type="integer" name="expense" id="edit-expense" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label>Date</label>
                                        <input type="date" name="date" id="edit-date" class="form-control">
                                    </div>
                                </div>
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
                    "url": "{{ route('other.getall') }}",
                    "type": "GET",
                    "dataType": "json",
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": function (response) {
                        if (response.status === 200) {
                            return response.other;
                        } else {
                            return [];
                        }
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "expense" },
                    { "data": "date" },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="'+data.id+'" data-name="'+data.name+'" data-expense="'+data.expense+'" data-date="'+data.date+'">Edit</a> ' +
                            '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="'+data.id+'">Delete</a>';
                        }
                    }
                ]
            });

            $('#myTable tbody').on('click', '.edit-btn', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var expense = $(this).data('expense');
                var date = $(this).data('date');

                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-expense').val(expense);
                $('#edit-date').val(date);
                $('#editModal').modal('show');
            });


            $('#other-form').submit(function (e) {
                e.preventDefault();
                const otherdata = new FormData(this);

                $.ajax({
                    url: '{{ route('other.store') }}',
                    method: 'post',
                    data: otherdata,
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
                            $('#other-form')[0].reset();
                            $('#exampleModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload();
                        }
                    }
                });
            });

        });


        $('#edit-form').submit(function (e) {
                e.preventDefault();
                const otherdata = new FormData(this);

                $.ajax({
                    url: '{{ route('other.update') }}',
                    method: 'POST',
                    data: otherdata,
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

                if (confirm('Are you sure you want to delete this expenses?')) {
                    $.ajax({
                        url: '{{ route('other.delete') }}',
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
