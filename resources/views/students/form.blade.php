<div class="modal fade" id="studentModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Student Form</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="studentForm">

                    @csrf

                    <input type="hidden" id="student_id" name="student_id">

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" id="name" class="form-control">

                        <span class="text-danger error-text name_error"></span>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="text" name="email" id="email" class="form-control">

                        <span class="text-danger error-text email_error"></span>

                    </div>

                    <div class="mb-3">

                        <label>Department</label>

                        <select name="department_id" id="department" class="form-control">

                            <option value="">Select Department</option>

                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">
                                    {{ $dept->name }}
                                </option>
                            @endforeach

                        </select>

                        <span class="text-danger error-text department_id_error"></span>

                    </div>

                    <div class="mb-3">

                        <label>Programme</label>

                        <select name="programme_id" id="programme" class="form-control">

                            <option value="">Select Programme</option>

                        </select>

                        <span class="text-danger error-text programme_id_error"></span>

                    </div>

                    <button type="submit" class="btn btn-success">Save</button>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="excelModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5>Upload Excel</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="excelForm" enctype="multipart/form-data">

                    @csrf

                    <input type="file" name="file" class="form-control">

                     <span class="text-danger error-text file_error"></span>

                    <button class="btn btn-success mt-3">
                        Upload
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
