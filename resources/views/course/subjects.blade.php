@extends('layouts.app')

@section('title', 'subject list')
@section('pageTitle', 'subjects list')

@section('content')
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-end mb-1">
            <button class="btn btn-primary btn-sm">
                <span class="mdi mdi-account-multiple-plus-outline"></span>
                &nbsp; new
            </button>
        </div>

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
                                    <span class="avatar-initial rounded-circle bg-primary">{{ $course->cousename[0] }}</span>
                                </div>
                            </td>
                            <td>{{ $course->cousename }}</td>
                            <td>{{ $course->shortname }}</td>
                            <td>{{ $course->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button class="btn btn-primary btn-sm">
                                        <span class="mdi mdi-account-edit-outline"></span>
                                        edit
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <span class="mdi mdi-trash-can-outline"></span>
                                        delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
