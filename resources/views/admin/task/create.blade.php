@extends('layout')

@section('content')
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-4 shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Country</h4>
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="bi bi-database-add"></i> ADD
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Country
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="country-form" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id ="cancel" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            form="country-form">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- edit modal --}}

                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Country</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-form" method="post">
                                    <input type="hidden" id="edit-id" name="id">
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>Name</label>
                                            <input type="text" id="edit-name" name="name"
                                                class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" form="edit-form">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('javascript')

<script>

    // show country
    $(document).ready(function() {

        var table = $('#myTable').DataTable({
            "ajax": {
                "url": "{{ route('country.getall') }}",
                "type": "GET",
                "dataType": "json",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataSrc": function(response) {
                    if (response.status === 200) {
                        return response.countries;
                    } else {
                        return [];
                    }
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="' +
                            data.id + '" data-name="' + data.name + '">Edit</a> ' +
                            '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="' +
                            data.id + '">Delete</a>';


                    }
                }
            ]
        });

        // create country

        $('#myTable tbody').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#editModal').modal('show');
        });


        $('#country-form').submit(function(e) {
            e.preventDefault();
            const countrydata = new FormData(this);

            $.ajax({
                url: '{{ route('country.store') }}',
                method: 'POST',
                data: countrydata,
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
                        $('#country-form')[0].reset();
                        $('#exampleModal').hide();
                        $('.modal-backdrop').remove();
                        $('#myTable').DataTable().ajax.reload();
                    }
                }
            });
        });

    });


    // update country
    $('#edit-form').submit(function(e) {
        e.preventDefault();
        const countrydata = new FormData(this);

        $.ajax({
            url: '{{ route('country.update') }}',
            method: 'POST',
            data: countrydata,
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
                    $('#editModal').hide();
                    $('.modal-backdrop').remove();
                    $('#myTable').DataTable().ajax.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // delete country
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this country?')) {
            $.ajax({
                url: '{{ route('country.delete') }}',
                type: 'DELETE',
                data: {
                    id: id
                },
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


