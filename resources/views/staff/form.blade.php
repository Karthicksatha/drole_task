<div class="modal fade" id="staffModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Add Staff</h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="staffForm">

                    @csrf

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" class="form-control">

                        <span class="text-danger error-text name_error"></span>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="text" name="email" class="form-control">

                        <span class="text-danger error-text email_error"></span>

                    </div>

                    <div class="mb-3">

                        <label>Department</label>

                        <select name="department_id" class="form-control">

                            <option value="">Select Department</option>

                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">
                                    {{ $dept->name }}
                                </option>
                            @endforeach

                        </select>

                        <span class="text-danger error-text department_id_error"></span>

                    </div>

                    <button class="btn btn-success">
                        Save
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
