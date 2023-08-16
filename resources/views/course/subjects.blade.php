@extends('layouts.app')

@section('title', 'subject list')
@section('pageTitle', 'subjects list')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">

                <div class="d-flex justify-content-end mb-1">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSubject">
                        <span class="mdi mdi-account-multiple-plus-outline"></span>
                        &nbsp; new
                    </button>
                </div>

                {{-- NEW SUBJECT MODAL --}}
                <div class="modal fade" id="createSubject" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('subject.store') }}" method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SUBJECT REGISTRATION</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="d-flex flex-column gap-3">
                                        {{-- course  name --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ old('cousename') }}" autocomplete="off" type="text"
                                                    name="cousename" class="form-control" placeholder="Course name">
                                                <label for="formValidationPhone">Course name</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('cousename')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- course short name --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ old('shortname') }}" autocomplete="off" type="text"
                                                    name="shortname" class="form-control" placeholder="Course shortname">
                                                <label for="formValidationPhone">Course short name</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('shortname')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="mdi mdi-content-save-check-outline"></span>
                                        Save course
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- END NEW SUBJECT MODAL --}}

                @if (count($courses) == 0)
                    <div class="alert alert-info">No subject available </div>
                @else
                    <table class="table table-striped" id="studentData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>avatar</th>
                                <th>subject name</th>
                                <th>short name</th>
                                <th>created since</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 0; @endphp
                            @foreach ($courses as $course)
                                @php $i++; @endphp
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ $i }}</span>
                                    </td>
                                    <td>
                                        <div class="avatar avatar-sm me-2">
                                            <span
                                                class="avatar-initial rounded-circle bg-primary">{{ $course->cousename[0] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $course->cousename }}</td>
                                    <td>{{ $course->shortname }}</td>
                                    <td>{{ $course->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editSubject-{{ $course->id }}">
                                                <span class="mdi mdi-account-edit-outline"></span>
                                                edit
                                            </button>
                                        </div>

                                        {{-- EDIT SUBJECT MODAL --}}
                                        <div class="modal fade" id="editSubject-{{ $course->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('subject.update', encrypt($course->id)) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">SUBJECT
                                                                INFORMATION UPDATE</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="d-flex flex-column gap-3">
                                                                {{-- course  name --}}
                                                                <div class="fv-plugins-icon-container">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <input value="{{ $course->cousename }}"
                                                                            autocomplete="off" type="text"
                                                                            name="cousename" class="form-control"
                                                                            placeholder="Course name">
                                                                        <label for="formValidationPhone">Course name</label>
                                                                    </div>
                                                                    <div
                                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                        @error('cousename')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                {{-- course short name --}}
                                                                <div class="fv-plugins-icon-container">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <input value="{{ $course->shortname }}"
                                                                            autocomplete="off" type="text"
                                                                            name="shortname" class="form-control"
                                                                            placeholder="Course shortname">
                                                                        <label for="formValidationPhone">Course short
                                                                            name</label>
                                                                    </div>
                                                                    <div
                                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                        @error('shortname')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <span class="mdi mdi-content-save-check-outline"></span>
                                                                Save changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- END EDIT SUBJECT MODAL --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
