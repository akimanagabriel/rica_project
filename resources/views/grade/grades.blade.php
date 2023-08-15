@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'grades and subjects')

@php
    use App\Models\Grad;
    use App\Models\Gradecourse;
@endphp

@section('content')
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-end mb-1">
            <button class="btn btn-primary btn-sm">
                <span class="mdi mdi-account-multiple-plus-outline"></span>
                &nbsp; new
            </button>
        </div>

        @if (count($gradescourses) == 0)
            <div class="alert alert-info">No subject available </div>
        @else
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">GRADES</th>
                        <th scope="col">SUBJECT</th>
                        <th scope="col">OPTION</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($gradescourses as $gradescourse)
                        <tr>
                            <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                            <td> GRADE {{ $gradescourse->grad }}</td>
                            @php
                                $results = Gradecourse::select('gradecourse.id', 'course.cousename')
                                    ->join('course', 'gradecourse.cid', '=', 'course.id')
                                    ->where('gradecourse.gid', $gradescourse->id)
                                    ->orderBy('course.id', 'ASC')
                                    ->get();
                            @endphp
                            <td>
                                <ul type="square" class="d-flex flex-column gap-3">
                                    @foreach ($results as $result)
                                        <li class="d-flex justify-content-between">
                                            <span>{{ $result->cousename }}</span>
                                            <button type='button' class='btn btn-danger btn-sm'>
                                                <span class="mdi mdi-trash-can-outline"></span>
                                                Delete
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            <td>


                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editUser{{ $gradescourse->id }}"> </i>Add Subject</button> </a>

                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editUser{{ $gradescourse->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body py-3 py-md-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h5 class="mb-2">ADD SUBJECT IN GRADE (
                                                        GRADE-{{ $gradescourse->grad }})</h5>

                                                </div>
                                                <form class="row g-6" method="post" action="{{ route('grade.store') }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" value="{{ $gradescourse->id }}" name="gid" />
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline mb-6">
                                                            <select class="form-select" name="cid"
                                                                id="bs-validation-country" required>
                                                                <option disabled selected value="">Select Subject
                                                                </option>
                                                                @foreach ($subjects as $subject)
                                                                    <option value="{{ $subject->id }}">
                                                                        {{ $subject->cousename }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="form-label"
                                                                for="bs-validation-country">Subject</label>
                                                            <div class="valid-feedback"> Looks good! </div>
                                                            <div class="invalid-feedback"> Please select Subject</div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <br>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                                    Changes</button>
                                                <button type="reset" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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

@endsection
