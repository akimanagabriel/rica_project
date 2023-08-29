@extends('layouts.app')

@section('title', 'profile')
@section('pageTitle', 'STUDENT PROFILE')

@section('content')

    <div class="my-4">
        <!-- Button to trigger the modal -->
        <button class="btn btn-primary" data-bs-target="#uploadModal" data-bs-toggle="modal" type="button">
            profile picture
        </button>

        <!-- The Modal -->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="uploadModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('student.profilePicture') }}" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">UPLOAD PROFILE PICTURE</h5>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            {{-- file picker --}}
                            <div class="mb-3">
                                <label class="form-label" for="formFile">Profile picture</label>
                                <input class="form-control" id="formFile" name="profilePicture" type="file">
                                <input class="form-control" name="studentId" name="profilePicture" type="hidden"
                                    value="{{ $student->id }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">cancel</button>
                            <button class="btn btn-primary" type="submit"><span class="mdi mdi-upload-outline"></span>
                                upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- START OF PROFILE DETAILS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {{-- profile --}}
                    <div class="d-flex flex-column justify-content-center align-items-center gap-4">
                        {{-- <img alt="profile pic" src="{{ $student->photo }}"> --}}
                        <div class="avatar avatar-xl me-2">
                            <span class="avatar-initial rounded-circle bg-label-secondary">{{ $student->name[0] }}</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <h5>{{ $student->name }}</h5>
                            <h6>{{ $student->regnumber }}</h6>
                            <p>GRADE-{{ $student->grade }}</p>
                            <button class="btn btn-success">student information</button>
                        </div>

                        <div>
                            <h5>Personal information</h5>
                            <p><strong>FATHER NAME</strong>: {{ $student->fname }}</p>
                            <p><strong>MOTHER NAME</strong>: {{ $student->mname }}</p>
                            <p><strong>PHONE NUMBER</strong>: {{ $student->fphone }}</p>
                            <p><strong>OTHER PHONE NUMBER</strong>: {{ $student->ophone }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- tabs --}}
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a aria-controls="slip" aria-selected="true" class="nav-link active" data-bs-toggle="tab"
                                href="#slip" id="home-tab" role="tab">congratulation slip</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a aria-controls="report" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                href="#report" id="report-tab" role="tab">report</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a aria-controls="order" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                href="#order" id="order-tab" role="tab">order form / spc</a>
                        </li>
                    </ul>

                    {{-- CONGRATULATION SLIP --}}
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="slip-tab" class="tab-pane fade show active" id="slip" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                @if ($slipData)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>grade</th>
                                                <th>academic year</th>
                                                <th>set number</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($slipData as $slip)
                                                <tr>
                                                    <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                                    <td>GRADE-{{ $slip->grade }}</td>
                                                    <td>{{ $slip->year }}</td>
                                                    <td>{{ $slip->setnumber }}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-info btn-sm">view</button>
                                                        <button class="btn btn-info btn-info btn-sm">print</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">No data found</div>
                                @endif

                            </div>
                        </div>

                        {{-- REPORT --}}
                        <div aria-labelledby="report-tab" class="tab-pane fade" id="report" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>grade</th>
                                            <th>academic year</th>
                                            <th>1 <sup>st</sup> term</th>
                                            <th>2 <sup>nd</sup> term</th>
                                            <th>3 <sup>rd</sup> term</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>grade</td>
                                            <td>academic year</td>
                                            <td>
                                                <button class="btn btn-info btn-info btn-sm">print</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-info btn-sm">print</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-info btn-sm">print</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- order form or spc --}}
                        <div aria-labelledby="order-tab" class="tab-pane fade" id="order" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table pb-5">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>grade</th>
                                            <th>academic year</th>
                                            <th>spc</th>
                                            <th>order form</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>grade</td>
                                            <td>academic year</td>
                                            <td>
                                                <button class="btn btn-info btn-outline-info btn-sm">view</button>
                                                <button class="btn btn-info btn-info btn-sm">print</button>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="dropdown">
                                                        <button aria-expanded="false"
                                                            class="btn btn-outline-info btn-sm dropdown-toggle"
                                                            data-bs-toggle="dropdown" id="viewOrderForm" type="button">
                                                            view
                                                        </button>
                                                        <ul aria-labelledby="viewOrderForm" class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Option 1</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 2</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 3</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="dropdown">
                                                        <button aria-expanded="false"
                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                            data-bs-toggle="dropdown" id="printOrderform" type="button">
                                                            view
                                                        </button>
                                                        <ul aria-labelledby="printOrderform" class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Option 1</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 2</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 3</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    @isset($students)
        {{-- student results --}}
        <div id="studentProgressResult">
            <div class="card mt-3">
                <div class="card-body">
                    @if (count($students) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table align-middle text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>names</th>
                                        <th>reg number</th>
                                        <th>grade</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsResultsMarks">

                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->regnumber }}</td>
                                            <td>GRADE-{{ $student->grade }}</td>
                                            <td>
                                                <form action="{{ route('student.profile') }}" method="post">
                                                    @csrf
                                                    <input name="studentId" type="hidden" value="{{ $student->id }}">
                                                    <button class="btn btn-primary btn-sm" type="submit">student
                                                        result</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">No student found</div>
                    @endif
                </div>
            </div>
        </div>
    @endisset


@endsection
