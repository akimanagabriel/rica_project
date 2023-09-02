@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'Pace')

@php
    use App\Models\Pace;
    use App\Models\Student;
    use App\Models\Grad;
    use Illuminate\Support\Facades\DB;

@endphp

@section('content')

    <center>
        <h4 class="page-title">PACE REQUEST BY STUDENT</h4>
    </center>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NAMES</th>
                    <th>BIRTH DATE</th>
                    <th>SCHOOL</th>
                    <th>SCHOOL YEAR</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>LICA</td>
                        <td>{{ decrypt($year) }}</td>
                    </tr>
                @endforeach



            </tbody>
        </table>
        <div class="product-list">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">

                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#newLearningCenter"
                                class="btn btn-outline-primary flex-1 me-2">PACE REQUEST</a>


                            <!-- Edit User Modal -->
                            <div class="modal fade" id="newLearningCenter" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content p-3 p-md-5">
                                        <div class="modal-body py-3 py-md-0">
                                            <div class="text-center mb-4">
                                                <h5 class="mb-2">PACE REQUEST</h5>
                                            </div>
                                            <form class="row g-4" method="post" action="{{ route('learning.store') }}">
                                                @csrf

                                                <div class="col-12">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" name="setnumber" required>
                                                            <option value="" selected disabled>Select Set Number
                                                            </option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>

                                                        </select>
                                                        <label class="form-label" for="bs-validation-country">Select Set
                                                            Number</label>
                                                        <div class="valid-feedback"> Looks good! </div>
                                                        <div class="invalid-feedback">Select Set Number</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" name="term" required>
                                                            <option value="" selected disabled>Select Term Number
                                                            </option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>

                                                        </select>
                                                        <label class="form-label" for="bs-validation-country">Select
                                                            Term</label>
                                                        <div class="valid-feedback"> Looks good! </div>
                                                        <div class="invalid-feedback">Select Term</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" name="paceid" required>
                                                            <option value="" selected disabled>Select Pace Name
                                                            </option>
                                                            @php

                                                                $res = DB::table('pace')
                                                                    ->select('pace.status', 'pace.id', 'course.short', 'pace.pacenumber', 'pace.qte', 'grad.grad', 'pace.grad as test')
                                                                    ->join('course', 'pace.course', '=', 'course.id')
                                                                    ->join('grad', 'pace.grad', '=', 'grad.id')
                                                                    ->whereRaw("pace.grad IN (SELECT graid FROM leaningcenter WHERE cid IN (SELECT cid FROM leaningcenter WHERE graid = '$grade'))")
                                                                    ->whereNotIn('pace.id', function ($query) use ($id) {
                                                                        $query
                                                                            ->select('paceid')
                                                                            ->from('pecerequest')
                                                                            ->where('stid', $id);
                                                                    })
                                                                    ->orderBy('grad.id', 'asc')
                                                                    ->orderBy('course.id', 'asc')
                                                                    ->orderBy('pace.pacenumber', 'asc')
                                                                    ->get();
                                                                $usera = DB::table('users')
                                                                    ->select('phone')
                                                                    ->where('level', '=', '2')
                                                                    ->where('status', '=', '1')
                                                                    ->first();

                                                            @endphp
                                                            @foreach ($res as $ress)
                                                                <option value="1">
                                                                    {{ $ress->short }}-{{ $ress->pacenumber }}</option>
                                                            @endforeach



                                                        </select>
                                                        <label class="form-label" for="bs-validation-country">Select
                                                            Term</label>
                                                        <div class="valid-feedback"> Looks good! </div>
                                                        <div class="invalid-feedback">Select Pace Name</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" id="modalEditUserName" name="comment"
                                                            class="form-control" placeholder="Comment" autocomplete="off"
                                                            required />
                                                        <label for="modalEditUserName">Comment</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" name="pacetype" required>

                                                            <option value="1" selected>Pysical PACE</option>
                                                            <option value="0">Eletronic PACE</option>

                                                        </select>
                                                        <label class="form-label" for="bs-validation-country">Select
                                                            Term</label>
                                                        <div class="valid-feedback"> Looks good! </div>
                                                        <div class="invalid-feedback">Select Term</div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="grade" value="{{ $grade }}">

                                                <input type="hidden" name="year" value=" {{ $year }}">


                                                <input type="hidden" name="stid" value="{{ $id }}">
                                                <input type="hidden" name="pid" value="{{ $id }}">

                                                <input type="hidden" name="grades" value="{{ $grade }}">

                                                <input type="hidden" name="yeart" value="{{ $year }}">

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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table id="datatable" class="table table-striped align-start text-nowrap mb-0"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>REQUEST SUBJECT</th>
                                        <th>PACE N.</th>
                                        <th>SET N.</th>
                                        <th>TERM</th>

                                        <th>DATE OF ISSUED</th>
                                        <th>DATE OF COMPLITION</th>
                                        <th>MARKS</th>
                                        <th>APPROVED</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>

                                            @php

                                                $query = DB::table('pace')
                                                    ->join('course', 'pace.course', '=', 'course.id')
                                                    ->where('pace.id', $result->paceid)
                                                    ->select('pace.pacenumber', 'course.short')
                                                    ->get();
                                                $admin = DB::table('users')
                                                    ->where('id', $result->tid)

                                                    ->get();

                                                // $result now contains the query result

                                            @endphp
                                            @foreach ($query as $queries)
                                                <td>{{ $queries->short }}</td>
                                                <td>{{ $queries->pacenumber }}</td>
                                            @endforeach

                                            <td>{{ $result->setnumber }}</td>
                                            <td>{{ $result->term }}</td>
                                            <td>{{ $result->deldate }}</td>
                                            <td>{{ $result->appdate }}</td>
                                            <td>{{ $result->marks }}</td>
                                            @foreach ($admin as $admins)
                                                <td>{{ $admins->name }}</td>
                                            @endforeach









                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                @endsection
