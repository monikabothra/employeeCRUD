@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Listing</h1>

        <a class="btn btn-outline mb-3" style="background-color: #A7BAC0;" data-bs-toggle="modal"
            data-bs-target="#employeeModal">New Employee+</a>




        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "{{ route('employee.index') }}";
                }, 1000);
            </script>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Employee Mobile-number</th>

                        <th>Employee DOB</th>
                        <th>Employee DOJ</th>
                        <th>Employee Designation</th>
                        <th>Employee Salary</th>


                        <th>Actions</th>


                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>monika</td>
                        <td>monika</td>
                        <td>monika</td>
                        <td>monika</td>
                        <td>monika</td>
                        <td>monika</td>
                        <td>monika</td>
                    </tr> --}}
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->mobile }}</td>

                            <td>{{ $employee->dob }}</td>
                            <td>{{ $employee->doj }}</td>
                            <td>{{ $employee->designations->designation ?? '' }}</td>
                            <td>{{ $employee->salary }}</td>


                            <td>
                                <div class="d-flex">


                                    <button class="btn btn-outline-primary btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#employeeModal" onclick="edit({{ $employee->id }})"><i
                                            class="fas fa-edit"></i></button>

                                    &nbsp;

                                    <button class="btn btn-outline-danger btn-delete"
                                        onclick="delete_emp({{ $employee->id }})"
                                        data-employee-id="{{ $employee->id }}"><i class="fas fa-trash-alt"></i></button>

                                </div>
                            </td>

                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>



    <!--begin::Modal - New Target-->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="employee_form" method="post" class="form" action="{{ route('employee.store') }}">
                        <input id="employee_method" type="hidden" name="_method" value="">

                        <!--begin::Heading-->
                        @csrf
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3" id="employee_header">New Employee</h1>
                            <!--end::Title-->

                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Employee Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Employee Name"
                                name="name" id="name" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="fs-6 fw-bold mb-2">Employee Email</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Employee Email"
                                name="email" id="email" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Col-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Employee MobileNo.</label>
                            <!--end::Label-->
                            <input type="number" class="form-control form-control-solid"
                                placeholder="Enter Employee Mobilano." name="mobile" id="mobile" />
                        </div>
                        <!--end::Col-->


                        <!--begin::Col-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Employee DOB</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">

                                <!--begin::Datepicker-->
                                <input type="date" name="dob" id="dateOfBirth" required class="form-control"
                                    placeholder="Date of Birth">
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Employee DOJ</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">

                                <!--begin::Datepicker-->
                                <input type="date" class="form-control form-control-solid ps-12"
                                    placeholder="Select a date" name="doj" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Employee Designation</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Select Project" name="designation" id="designation">
                                <option value="">Select Designation...</option>
                                {{-- <option value="1">manager</option> --}}
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
                                @endforeach

                            </select>
                        </div>

                        <!--begin::Col-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Employee Salary</label>
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Employee Salary" name="salary" id="salary" />
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->


                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="employee_form_button" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>

                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->

    <!-- JavaScript to handle the modal and AJAX     -->

    <script>
        $(document).ready(function() {
            $("#employee_form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 20,
                        // lettersonly: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50,
                    },
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true,
                    },
                    salary: {
                        required: true,
                        number: true,

                    },
                    dob: {
                        required: true,
                        date: true
                    },
                    doj: {
                        required: true,
                        date: true
                    },
                    designation: {
                        required: true,

                    },

                },
                messages: {
                    name: {
                        required: "name is required",
                        maxlength: "First name cannot be more than 20 characters",
                        // lettersonly: "name contains alphabates only",
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    mobile: {
                        required: "Mobile number is required",
                        minlength: "Mobile number must be of 10 digits"
                    },
                    salary: {
                        required: "salary is required",
                        date: "salary should be a valid number"
                    },
                    dob: {
                        required: "Date of birth is required",
                        date: "Date of birth should be a valid date"
                    },
                    doj: {
                        required: "Date of Joinning is required",
                        date: "Date of Joinning should be a valid date"
                    },

                    designation: {
                        required: "designation is required",

                    },



                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
