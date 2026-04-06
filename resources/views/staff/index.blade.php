@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h5>Staff Management</h5>

            <button class="btn btn-primary" id="addStaffBtn">
                Add Staff
            </button>

        </div>

        <div class="card-body">

            <table id="staffTable" class="table table-bordered">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                    </tr>

                </thead>

            </table>

        </div>

    </div>

    @include('staff.form')
@endsection

@push('scripts')
    <script>
        let table = $('#staffTable').DataTable({

            processing: true,
            serverSide: true,

            ajax: "{{ route('staff.data') }}",

            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'department'
                }
            ]

        });


        $('#addStaffBtn').click(function() {

            $('#staffModal').modal('show');

        });


        $('#staffForm').submit(function(e) {

            e.preventDefault();

            $.ajax({

                url: "{{ route('staff.store') }}",

                type: "POST",

                data: $(this).serialize(),

                success: function(res) {

                    alert(res.success);

                    $('#staffModal').modal('hide');

                    $('#staffForm')[0].reset();

                    table.ajax.reload();

                },

                error: function(err) {

                    $('.error-text').text('');

                    $.each(err.responseJSON.errors, function(key, value) {

                        $('.' + key + '_error').text(value[0]);

                    });

                }

            });

        });
    </script>
@endpush
