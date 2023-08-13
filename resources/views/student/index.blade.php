@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', 'Students list')

@section('content')
    <div class="table-responsive text-nowrap">

        @if (count($students) == 0)
            <div class="alert alert-info">No students available </div>
        @else
            <table class="table table-striped">
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
                                            <span class="avatar-initial rounded-circle bg-success">pi</span>
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
                            <td>{{ $student->cdate }}</td>
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
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="mdi mdi-trash-can-outline me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
