@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'PACE REQUEST BY STUDENT')

@php
    use App\Models\Pace;
    use App\Models\Student;
    use App\Models\Grad;
    use Illuminate\Support\Facades\DB;
    
@endphp

@section('content')



    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <table class="table table-bordered shadow-sm no-data-table">
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

                <div class="">

                    <div class="d-flex justify-content-end align-items-end my-2">
                        <a class="btn btn-primary flex-1" data-bs-target="#newLearningCenter"
                            data-bs-toggle="modal" href="javascript:void(0)">PACE REQUEST</a>
                    </div>


                    <!-- Edit User Modal -->
                    <div aria-hidden="true" class="modal fade" id="newLearningCenter" tabindex="-1">
                        <div class="modal-dialog ">
                            <div class="modal-content p-3 p-md-5">
                                <div class="modal-body py-3 py-md-0">
                                    <div class="text-center my-4">
                                        <h5 class="mb-2">PACE REQUEST</h5>
                                    </div>
                                    <form action="{{ route('learning.store') }}" class="row g-4" method="post">
                                        @csrf

                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" name="setnumber" required>
                                                    <option disabled selected value="">Select Set Number
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
                                                    <option disabled selected value="">Select Term Number
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
                                                    <option disabled selected value="">Select Pace Name
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
                                                <input autocomplete="off" class="form-control" id="modalEditUserName"
                                                    name="comment" placeholder="Comment" required type="text" />
                                                <label for="modalEditUserName">Comment</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" name="pacetype" required>

                                                    <option selected value="1">Pysical PACE</option>
                                                    <option value="0">Eletronic PACE</option>

                                                </select>
                                                <label class="form-label" for="bs-validation-country">Select
                                                    Term</label>
                                                <div class="valid-feedback"> Looks good! </div>
                                                <div class="invalid-feedback">Select Term</div>
                                            </div>
                                        </div>
                                        <input name="grade" type="hidden" value="{{ $grade }}">

                                        <input name="year" type="hidden" value=" {{ $year }}">


                                        <input name="stid" type="hidden" value="{{ $id }}">
                                        <input name="pid" type="hidden" value="{{ $id }}">

                                        <input name="grades" type="hidden" value="{{ $grade }}">

                                        <input name="yeart" type="hidden" value="{{ $year }}">

                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary me-sm-3 me-1" type="submit">Save
                                                Changes</button>
                                            <button aria-label="Close" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal" type="reset">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Edit User Modal -->
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped align-start text-nowrap mb-0" id="datatable"
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
            </div>
        </div>
    </div>

@endsection
