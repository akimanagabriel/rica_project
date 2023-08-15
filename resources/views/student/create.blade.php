@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', 'STUDENT REGISTRATION')

@section('content')
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Personal Information</h6>
                <div class="d-flex align-items-center">
                </div>
            </div>
            <form id="formValidationExamples" method="post" action="{{ route('student.store') }}"
                class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
                @csrf
                <!-- Account Details -->

                <!-- First Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="formValidationName" name="name" class="form-control"
                            placeholder="Names" name="formValidationName"  autocomplete="off">
                        <label for="formValidationName">Names</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Second Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="province" id="bs-validation-country">
                            <option disabled selected value="">Select Provence</option>
                            @foreach ($provinces as $item)
                                <option value="{{ $item->province }}">{{ $item->province }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            @error('province')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Third Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="text" id="formValidationPhone" name="fphone"
                            class="form-control" placeholder="Your Phone" name="formValidationPhone">
                        <label for="formValidationPhone">First Phone</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('fphone')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="date" id="formValidationName" name="dob" class="form-control"
                            placeholder="John Doe" name="formValidationName">
                        <label for="formValidationName">Date Of Birth</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('dob')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Second Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="district" id="bs-validation-country">
                            <option disabled selected value="">Select District</option>
                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('district')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!-- Third Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="text" id="formValidationPhone" name="ophone"
                            class="form-control" placeholder="Second Phone" name="formValidationPhone">
                        <label for="formValidationPhone">Second Phone</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('ophone')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="text" id="formValidationName" name="fname" class="form-control"
                            placeholder="Father Name" name="formValidationName">
                        <label for="formValidationName">Father Name</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('fname')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Second Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="sector" id="bs-validation-country">
                            <option disabled selected value="">Select Sector</option>
                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('sector')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!-- Third Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="text" id="formValidationPhone" name="comment" value="NONE"
                            class="form-control" placeholder="Your comment" name="formValidationPhone">
                        <label for="formValidationPhone">Comment</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline">
                        <input autocomplete="off" type="text" id="formValidationName" name="mname"
                            class="form-control" placeholder="Mother Name" name="formValidationName">
                        <label for="formValidationName">Mather Name</label>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('mname')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Second Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="cell" id="bs-validation-country">
                            <option disabled selected value=""> Select Cell</option>

                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('cell')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="status" id="bs-validation-country">
                            <option disabled selected value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Passive</option>

                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('status')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!-- Third Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="gender" id="bs-validation-country">
                            <option disabled selected value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!-- Second Input Field -->
                <div class="col-md-4 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" name="village" id="bs-validation-country">
                            <option disabled selected value="">Select Village</option>
                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('village')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-2">
                        <select class="form-select" name="year" id="bs-validation-country">
                            <option disabled selected value="">Select Academic Year</option>
                            @foreach ($academics as $academic)
                                <option value="{{ $academic->year }}">{{ $academic->year }}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('year')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 fv-plugins-icon-container">
                    <div class="form-floating form-floating-outline mb-2">
                        <select class="form-select" name="grade" id="bs-validation-country">
                            <option disabled selected value="">Select Academic Year</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->grad }}">GRADE-{{ $grade->grad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('grade')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Save</button>
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
                <!-- Third Input Field -->

            </form>

        </div>

        @include('student.countryJs')

    @endsection
