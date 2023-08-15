@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', 'Students list')

@section('content')
    <div class="table-responsive text-nowrap">

        @if (count($students) == 0)
            <div class="alert alert-info">No students available </div>
        @else
            <table class="table table-striped" id="studentData">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>profile</th>
                        <th>reg number</th>
                        <th>names</th>
                        <th>grade</th>
                        <th>date of birth</th>
                        <th>acc year</th>
                        <th>father</th>
                        <th>mother</th>
                        <th>1<sup>st</sup> phone</th>
                        <th>2<sup>nd</sup> phone</th>
                        <th>district</th>
                        <th>sector</th>
                        <th>status</th>
                        <th>option</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 0; @endphp
                    @foreach ($students as $student)
                        @php $i++; @endphp
                        <tr>
                            <td>
                                <span class="fw-medium">{{ $i }}</span>
                            </td>
                            <td>
                                <div>
                                    @if (isset($student->photo))
                                        {{-- <img src="{{ $student->photo }}" alt=""> --}}
                                        <div class="avatar avatar-sm me-2">
                                            <span
                                                class="avatar-initial rounded-circle bg-primary">{{ $student->name[0] }}</span>
                                        </div>
                                    @else
                                        <div class="avatar avatar-sm me-2">
                                            @if ($student->gender == 'Male')
                                                <img src="{{ asset('assets/img/avatars/3.png') }}" class="rounded-circle"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('assets/img/avatars/12.png') }}" class="rounded-circle"
                                                    alt="">
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ strtoupper($student->regnumber) }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade }}</td>
                            <td>{{ $student->cdate }}</td>
                            <td>{{ $student->year }}</td>
                            <td>{{ $student->fname }}</td>
                            <td>{{ $student->mname }}</td>
                            <td>{{ $student->fphone }}</td>
                            <td>{{ $student->ophone }}</td>
                            <td>{{ $student->district }}</td>
                            <td>{{ $student->sector }}</td>
                            <td>
                                @if ($student->status)
                                    <div class='badge bg-label-success'>Active</div>
                                @else
                                    <div class='badge bg-label-danger'>Inactive</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#editStudent-{{ $student->id }}"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</button>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteStudent-{{ $student->id }}"><i
                                                class="mdi mdi-trash-can-outline me-1"></i>
                                            Delete</button>
                                    </div>
                                </div>

                                {{-- delete comfirmation modal --}}
                                <div class="modal fade" id="deleteStudent-{{ $student->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('student.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this item?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- END OF DELETE MODEL --}}


                                {{-- EDIT MODAL --}}
                                <div class="modal fade" id="editStudent-{{ $student->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('student.update', encrypt($student->id)) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">STUDENT INFORMATION
                                                        UPDATE</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- FORM DETAILS --}}
                                                    <div class="row">
                                                        <!-- First Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="formValidationName" name="name"
                                                                    class="form-control" placeholder="Names"
                                                                    name="formValidationName" autocomplete="off">
                                                                <label for="formValidationName">Names</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Second Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="province"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select Provence
                                                                    </option>
                                                                    @foreach ($provinces as $item)
                                                                        <option value="{{ $item->province }}">
                                                                            {{ $item->province }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('province')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Third Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="text"
                                                                    id="formValidationPhone" name="fphone"
                                                                    class="form-control" placeholder="Your Phone"
                                                                    name="formValidationPhone">
                                                                <label for="formValidationPhone">First Phone</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('fphone')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="date"
                                                                    id="formValidationName" name="dob"
                                                                    class="form-control" placeholder="John Doe"
                                                                    name="formValidationName">
                                                                <label for="formValidationName">Date Of Birth</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('dob')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Second Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="district"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select
                                                                        District
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('district')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- Third Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="text"
                                                                    id="formValidationPhone" name="ophone"
                                                                    class="form-control" placeholder="Second Phone"
                                                                    name="formValidationPhone">
                                                                <label for="formValidationPhone">Second Phone</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('ophone')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="text"
                                                                    id="formValidationName" name="fname"
                                                                    class="form-control" placeholder="Father Name"
                                                                    name="formValidationName">
                                                                <label for="formValidationName">Father Name</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('fname')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Second Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="sector"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select Sector
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('sector')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- Third Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="text"
                                                                    id="formValidationPhone" name="comment"
                                                                    value="NONE" class="form-control"
                                                                    placeholder="Your comment" name="formValidationPhone">
                                                                <label for="formValidationPhone">Comment</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('comment')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline">
                                                                <input autocomplete="off" type="text"
                                                                    id="formValidationName" name="mname"
                                                                    class="form-control" placeholder="Mother Name"
                                                                    name="formValidationName">
                                                                <label for="formValidationName">Mather Name</label>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('mname')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Second Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="cell"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value=""> Select Cell
                                                                    </option>

                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('cell')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="status"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select Status
                                                                    </option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Passive</option>

                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('status')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- Third Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="gender"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select Gender
                                                                    </option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>

                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('gender')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- Second Input Field -->
                                                        <div class="col-md-4 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-4">
                                                                <select class="form-select" name="village"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select Village
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('village')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-2">
                                                                <select class="form-select" name="year"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select
                                                                        Academic
                                                                        Year</option>
                                                                    @foreach ($academics as $academic)
                                                                        <option value="{{ $academic->year }}">
                                                                            {{ $academic->year }}</option>
                                                                    @endforeach


                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('year')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 fv-plugins-icon-container">
                                                            <div class="form-floating form-floating-outline mb-2">
                                                                <select class="form-select" name="grade"
                                                                    id="bs-validation-country">
                                                                    <option disabled selected value="">Select
                                                                        Academic
                                                                        Year</option>
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->grad }}">
                                                                            GRADE-{{ $grade->grad }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                @error('grade')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- END FORM DETAILS --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- END EDIT MODEL --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>


    @include('student.countryJs')
@endsection
