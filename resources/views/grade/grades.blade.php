@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'grades and subjects')

@php
    use App\Models\Grad;
    use App\Models\Gradecourse;
@endphp

@section('content')
    <div class="card">
        <div class="card-body">



            <div class="table-responsive text-nowrap">

                @if (count($gradescourses) == 0)
                    <div class="alert alert-info">No subject available </div>
                @else
                    <table id="datatable" class="table table-striped align-start text-nowrap mb-0" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">GRADES</th>
                                <th scope="col">SUBJECTS</th>
                                <th scope="col">OPTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gradescourses as $gradescourse)
                                <tr>
                                    <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td> GRADE-{{ $gradescourse->grad }}</td>
                                    @php
                                        $gcourses = Gradecourse::select('gradecourse.id', 'course.cousename')
                                            ->join('course', 'gradecourse.cid', '=', 'course.id')
                                            ->where('gradecourse.gid', $gradescourse->id)
                                            ->orderBy('course.id', 'ASC')
                                            ->get();
                                    @endphp
                                    <td>
                                        <ul type="square" class="d-flex flex-column gap-2">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($gcourses as $gcourse)
                                                @php
                                                    $i++;
                                                @endphp
                                                <li class="d-flex justify-content-between">
                                                    <span>{{ $i }}. {{ $gcourse->cousename }}</span>
                                                    <button type='button' class='btn btn-danger btn-sm'
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#removeCourse-{{ $gcourse->id }}">
                                                        <span class="mdi mdi-trash-can-outline"></span>
                                                        Delete
                                                    </button>
                                                </li>

                                                {{-- START DELETE COMFIRM MODAL --}}
                                                <div class="modal fade" id="removeCourse-{{ $gcourse->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('grade.destroy', encrypt($gcourse->id)) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                        {{ $gcourse->cousename }}?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to remove
                                                                        <strong>{{ $gcourse->cousename }}</strong> course in
                                                                        <strong>GRADE-{{ $gradescourse->grad }}</strong> ?
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        data-bs-dismiss="modal">yes</button>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- END DELETE COMFIRM MODAL --}}
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>


                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addcourseToGrade{{ $gradescourse->id }}"> Add Subject</button>

                                        <!-- add grade to course Modal -->
                                        <div class="modal fade" id="addcourseToGrade{{ $gradescourse->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                                <div class="modal-content p-3 p-md-5">
                                                    <form class="row g-6" method="post"
                                                        action="{{ route('grade.store') }}">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-body py-3 py-md-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h5 class="mb-2">ADD SUBJECT IN GRADE
                                                                    (GRADE-{{ $gradescourse->grad }})</h5>

                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-floating form-floating-outline mb-6">
                                                                    <input type="hidden" value="{{ $gradescourse->id }}"
                                                                        name="gid" />
                                                                    <select class="form-select" name="cid"
                                                                        id="bs-validation-country" required
                                                                        {{ $subjects->count() == 0 ? 'disabled' : '' }}>
                                                                        <option disabled selected value="">{{ $subjects->count() == 0 ? 'No subject available' : 'Select subject' }}
                                                                        </option>
                                                                        @foreach ($subjects as $subject)
                                                                            <option value="{{ $subject->id }}">
                                                                                {{ $subject->cousename }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label class="form-label"
                                                                        for="bs-validation-country">Subject</label>
                                                                    <div class="valid-feedback"> Looks good! </div>
                                                                    <div class="invalid-feedback"> Please select Subject
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer mt-4">
                                                            <button type="reset" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                                                Changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
            </div>
            <!--/ Edit User Modal -->


            </tr>
            @endforeach
            </tbody>
            </table>
            @endif
        </div>

    </div>

@endsection
