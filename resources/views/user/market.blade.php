@extends('user.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4 shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Market List</h4>
                        {{-- <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-database-add"></i> ADD
                        </button> --}}
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
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                        </table>
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
                    "url": "{{ route('market.getall') }}",
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
                    // {
                    //     "data": null,
                    //     "render": function (data, type, row) {
                    //         return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="'+data.id+'" data-date="'+data.date+'"data-accessories="'+data.accessories+'" data-amount="'+data.amount+'" data-user_id="'+data.user_id+'"></a> ' +
                    //         '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="'+data.id+'"></a>';
                    //     }
                    // }
                ]
            });


        });

    </script>
@endpush
