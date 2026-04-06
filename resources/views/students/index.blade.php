@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h5>Students</h5>

            <button class="btn btn-primary" id="addStudentBtn">
                Add Student
            </button>
            <button class="btn btn-success" id="importExcelBtn">
                Import Excel
            </button>

        </div>

        <div class="card-body">

            <table id="studentsTable" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Programme</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>

        </div>

    </div>

    @include('students.form')
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            /*
            |--------------------------------------------------------------------------
            | DataTable Initialization
            |--------------------------------------------------------------------------
            */

            let table = $('#studentsTable').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ route('students.data') }}",

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
                    },
                    {
                        data: 'programme'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]

            });


            /*
            |--------------------------------------------------------------------------
            | Open Create Modal
            |--------------------------------------------------------------------------
            */

            $('#addStudentBtn').click(function() {

                $('#studentForm')[0].reset();

                $('#student_id').val('');

                $('.error-text').text('');

                $('#programme').html('<option value="">Select Programme</option>');

                $('#studentModal').modal('show');

            });


            /*
            |--------------------------------------------------------------------------
            | Load Programmes by Department
            |--------------------------------------------------------------------------
            */

            function loadProgrammes(department_id, selectedProgramme = null) {

                $.get('/programmes/' + department_id, function(data) {

                    $('#programme').empty();

                    $('#programme').append('<option value="">Select Programme</option>');

                    $.each(data, function(key, value) {

                        let selected = selectedProgramme == value.id ? 'selected' : '';

                        $('#programme').append(
                            '<option value="' + value.id + '" ' + selected + '>' + value.name +
                            '</option>'
                        );

                    });

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Department Change Event
            |--------------------------------------------------------------------------
            */

            $(document).on('change', '#department', function() {

                let department_id = $(this).val();

                if (department_id != '') {
                    loadProgrammes(department_id);
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Create / Update Student
            |--------------------------------------------------------------------------
            */

            $('#studentForm').submit(function(e) {

                e.preventDefault();

                let id = $('#student_id').val();

                let url = id ? '/students/update/' + id : '/students/store';

                $.ajax({

                    url: url,
                    type: "POST",
                    data: $(this).serialize(),

                    success: function(response) {

                        alert(response.success);

                        $('#studentModal').modal('hide');

                        $('#studentForm')[0].reset();

                        $('.error-text').text('');

                        table.ajax.reload();

                    },

                    error: function(error) {

                        $('.error-text').text('');

                        $.each(error.responseJSON.errors, function(key, value) {

                            $('.' + key + '_error').text(value[0]);

                        });

                    }

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Edit Student
            |--------------------------------------------------------------------------
            */

            $(document).on('click', '.editBtn', function() {

                let id = $(this).data('id');

                $.get('/students/' + id + '/edit', function(data) {

                    $('#student_id').val(data.id);

                    $('#name').val(data.name);

                    $('#email').val(data.email);

                    $('#department').val(data.department_id);

                    loadProgrammes(data.department_id, data.programme_id);

                    $('#studentModal').modal('show');

                });

            });


        });

        $('#importExcelBtn').click(function() {

            $('#excelModal').modal('show');

        });

        $('#excelForm').submit(function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: '/students/import',

                type: 'POST',

                data: formData,

                processData: false,
                contentType: false,

                success: function(res) {

                    alert(res.success);

                    $('#excelModal').modal('hide');

                },

                error: function(error) {

                    $('.error-text').text('');

                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(key, value) {

                            $('.' + key + '_error').text(value[0]);

                        });
                    }

                }

            });

        });
    </script>
@endpush
