@extends('layouts.app')

@section('title', 'alumini list')
@section('pageTitle', 'LICA STUDENT LIST(DISABLED)')

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
                                    <div class="avatar avatar-sm me-2">
                                        @if ($student->gender == 'Male')
                                            <img src="{{ asset('assets/img/avatars/3.png') }}" class="rounded-circle"
                                                alt="">
                                        @else
                                            <img src="{{ asset('assets/img/avatars/12.png') }}" class="rounded-circle"
                                                alt="">
                                        @endif
                                    </div>
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
                                                                <input value="{{ $student->name }}" type="text"
                                                                    id="formValidationName" name="name"
                                                                    class="form-control" placeholder="Names"
                                                                    autocomplete="off">
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
                                                                    </option>
                                                                    @foreach ($provinces as $item)
                                                                        <option value="{{ $item->province }}"
                                                                            {{ $student->province == $item->province ? 'selected' : '' }}>
                                                                            {{ $item->province }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="formValidationName">Province</label>
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
                                                                <input value="{{ $student->fphone }}" autocomplete="off"
                                                                    type="text" id="formValidationPhone" name="fphone"
                                                                    class="form-control" placeholder="Your Phone">
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
                                                                <input value="{{ $student->cdate }}" autocomplete="off"
                                                                    type="date" id="formValidationName" name="dob"
                                                                    class="form-control" placeholder="John Doe">
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
                                                                    <option disabled selected
                                                                        value="{{ $student->district }}">
                                                                        {{ $student->district }}
                                                                    </option>
                                                                    <label for="formValidationName">Dstrict</label>
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
                                                                <input value="{{ $student->ophone }}" autocomplete="off"
                                                                    type="text" id="formValidationPhone"
                                                                    name="ophone" class="form-control"
                                                                    placeholder="Second Phone" name="formValidationPhone">
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
                                                                <input value="{{ $student->fname }}" autocomplete="off"
                                                                    type="text" id="formValidationName" name="fname"
                                                                    class="form-control" placeholder="Father Name">
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
                                                                    <option disabled selected
                                                                        value="{{ $student->sector }}">
                                                                        {{ $student->sector }}
                                                                    </option>
                                                                </select>
                                                                <label for="formValidationName">Sector</label>
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
                                                                    value="{{ $student->comment }}" class="form-control"
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
                                                                <input value="{{ $student->mname }}" autocomplete="off"
                                                                    type="text" id="formValidationName" name="mname"
                                                                    class="form-control" placeholder="Mother Name">
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
                                                                    <option disabled selected
                                                                        value="{{ $student->cell }}">{{ $student->cell }}
                                                                    </option>
                                                                </select>
                                                                <label for="formValidationName">Cell</label>
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
                                                                    <option value="1"
                                                                        {{ $student->status == 1 ? 'selected' : '' }}>
                                                                        Active
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ $student->status == 0 ? 'selected' : '' }}>
                                                                        Passive
                                                                    </option>
                                                                </select>
                                                                <label for="formValidationName">Status</label>
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
                                                                    <option value="Male"
                                                                        {{ $student->status == 'Male' ? 'selected' : '' }}>
                                                                        Male</option>
                                                                    <option value="Female"
                                                                        {{ $student->status == 'Female' ? 'selected' : '' }}>
                                                                        Female</option>

                                                                </select>
                                                                <label for="formValidationName">Gender</label>
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
                                                                    <option disabled selected
                                                                        value="{{ $student->village }}">
                                                                        {{ $student->village }}</option>
                                                                </select>
                                                                <label for="formValidationName">Village</label>
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
                                                                    @foreach ($academics as $academic)
                                                                        <option value="{{ $academic->year }}"
                                                                            {{ $student->year == $academic->year ? 'selected' : '' }}>
                                                                            {{ $academic->year }}</option>
                                                                    @endforeach


                                                                </select>
                                                                <label for="formValidationName">Academic year</label>
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
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->grad }}"
                                                                            {{ $student->grade == $grade->grad ? 'selected' : '' }}>
                                                                            GRADE-{{ $grade->grad }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="formValidationName">Grade</label>
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
