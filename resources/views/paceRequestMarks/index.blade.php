@extends('layouts.app')

@section('title', 'pace requests')
@section('pageTitle', 'PACE REQUESTING/MARKS RECORDING')

@php
    use App\Models\PaceRequest;
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pace.requests.marks') }}" class="row" method="get">
                <div class="form-floating form-floating-outline col-md-6">
                    <select class="select2 form-select form-select-lg" data-allow-clear="true" id="centerSelector"
                        name="lcId">
                        @foreach ($centers as $lc)
                            <option value="{{ encrypt($lc->id) }}">{{ $lc->cname }}</option>
                        @endforeach
                    </select>
                    <label for="select2Basic">Learning center</label>
                </div>

                <div class="form-floating form-floating-outline col-md-6">
                    <select class="select2 form-select form-select-lg" data-allow-clear="true" id="gradesSelector"
                        name="gradeId">
                    </select>
                    <label for="select2Basic">Grades</label>
                </div>

                <div class="mt-2 d-flex justify-content-end gap-3">
                    <button class="btn btn-danger" type="button">cancel</button>
                    <button class="btn btn-primary" type="submit">view studet</button>
                </div>

            </form>
        </div>
    </div>

    {{-- student results --}}
    {{-- @dd($students) --}}
    @isset($students)
        <div id="studentProgressResult">
            {{-- grade scripture --}}
            <div class="mt-3 d-flex justify-content-end" id="scriptureBtn">
                <a class="btn btn-primary text-white" href="{{ route('scripture.index') }}" id="scriptureLink">grade
                    scripture
                </a>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>names</th>
                                    <th>reg number</th>
                                    <th>grade</th>
                                    <th>grade progress</th>
                                    <th>term progress</th>
                                    <th>current set/term</th>
                                    <th>results</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="studentsResultsMarks">
                                @foreach ($students as $student)
                                    {{--  --}}
                                    @php
                                        $stid = $student->id;
                                        $year = $student->year;

                                        $curentset = PaceRequest::where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->max('setnumber');
                                        $curentset =  $curentset ?? 0;

                                        $curenttemsResult = DB::table('pecerequest')
                                            ->where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->max('term');

                                        // Extract the 'tems' value from the result
                                        $curenttems = $curenttemsResult ?? 0;
                                        // dd($grade);
                                        
                                        
                                        $totalpace = PaceRequest::where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->count();
                                        
                                        $totalone = PaceRequest::where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->where('term', 1)
                                            ->count();
                                        
                                        $totaltwo = PaceRequest::where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->where('term', 2)
                                            ->count();
                                        
                                        $totalthree = PaceRequest::where('stid', $stid)
                                            ->where('gradeid', $grade->id)
                                            ->where('year', $year)
                                            ->where('status', '>=', 3)
                                            ->where('term', 3)
                                            ->count();
                                        
                                        // calculation
                                        if ($totalpace <= 72) {
                                            $performance = (100 / 72) * $totalpace;
                                            $progone = (100 / 24) * $totalone;
                                            $progtwo = (100 / 24) * $totaltwo;
                                            $progthree = (100 / 24) * $totalthree;
                                        } elseif ($totalpace < 78) {
                                            $performance = (100 / 78) * $totalpace;
                                            $progone = (100 / 26) * $totalone;
                                            $progtwo = (100 / 26) * $totaltwo;
                                            $progthree = (100 / 26) * $totalthree;
                                        } elseif ($totalpace < 84) {
                                            $performance = (100 / 84) * $totalpace;
                                            $progone = (100 / 28) * $totalone;
                                            $progtwo = (100 / 28) * $totaltwo;
                                            $progthree = (100 / 28) * $totalthree;
                                        } elseif ($totalpace < 90) {
                                            $performance = (100 / 90) * $totalpace;
                                            $progone = (100 / 30) * $totalone;
                                            $progtwo = (100 / 30) * $totaltwo;
                                            $progthree = (100 / 30) * $totalthree;
                                        } elseif ($totalpace < 96) {
                                            $performance = (100 / 96) * $totalpace;
                                            $progone = (100 / 32) * $totalone;
                                            $progtwo = (100 / 32) * $totaltwo;
                                            $progthree = (100 / 32) * $totalthree;
                                        }
                                        
                                        // colors management
                                        if($performance>75) {
                                                $color ='bg-success'; 
                                            }else if($performance<75   && $performance>50){
                                                $color ='bg-info'; 
                                            }else if($performance<50   && $performance>25){
                                                $color ='bg-warning'; 
                                            }else {

                                                $color ='bg-danger'; 
                                            }


                                            if($progone>75){
                                                $colorone ='bg-success'; 
                                            }else if($progone<75   && $progone>50){
                                                $colorone ='bg-info'; 
                                            }else if($progone<50   && $progone>25){
                                                $colorone ='bg-warning'; 
                                            }else{
                                                $colorone ='bg-danger'; 
                                            }


                                            if($progtwo>75){
                                                $colortwo ='bg-success'; 
                                            }else if($progtwo<75   && $progtwo>50){
                                                $colortwo ='bg-info'; 
                                            }else if($progtwo<50   && $progtwo>25){
                                                $colortwo ='bg-warning'; 
                                            }else{
                                                $colortwo ='bg-danger'; 
                                            }
                                            
                                            if($progthree>75){
                                                $colorthree='bg-success'; 
                                            }else if($progthree<75   && $progthree>50){
                                                $colorthree='bg-info'; 
                                            }else if($progthree<50   && $progthree>25){
                                                $colorthree ='bg-warning'; 
                                            }else{
                                                $colorthree ='bg-danger'; 
                                            }
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->regnumber }}</td>
                                        <td>GRADE-{{ $student->grade }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated"
                                                     role="progressbar"
                                                     style="width: {{ number_format($performance, 1) }}%;"
                                                     aria-valuenow="{{ number_format($performance, 1) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">{{ number_format($performance, 1) }}%
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar {{ $colorone }}" role="progressbar"
                                                     style="width: {{ number_format($progone, 1) }}%;"
                                                     aria-valuenow="{{ number_format($progone, 1) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">{{ number_format($progone, 1) }}%</div>
                                            </div>
                                            <br>
                                            <div class="progress">
                                                <div class="progress-bar {{ $colortwo }}" role="progressbar"
                                                     style="width: {{ number_format($progtwo, 1) }}%;"
                                                     aria-valuenow="{{ number_format($progtwo, 1) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">{{ number_format($progtwo, 1) }}%</div>
                                            </div>
                                            <br>
                                            <div class="progress">
                                                <div class="progress-bar {{ $colorthree }}" role="progressbar"
                                                     style="width: {{ number_format($progthree, 1) }}%;"
                                                     aria-valuenow="{{ number_format($progthree, 1) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">{{ number_format($progthree, 1) }}%</div>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            {{ "S: " }}
                                            {{ $curentset }}
                                            <br>
                                            {{ "T: " }}
                                            {{ $curenttems }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('pace.report') }}" method="get">
                                                    <input type="hidden" name="current" value="{{ $curentset }}">
                                                    <input type="hidden" name="student" value="{{ encrypt($student->id) }}">
                                                    <input type="hidden" name="grade" value="{{ $student->grade }}">
                                                    <input type="hidden" name="year" value="{{ $student->year }}">
                                                    <button type="submit" class="btn btn-info btn-sm rounded-pill">result</button>
                                                </form>
                                                <button class="btn btn-primary btn-sm rounded-pill">report</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" id="dropdownMenuButton" type="button">
                                                    action
                                                </button>
                                                <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">PACE Request</a></li>
                                                    <li><a class="dropdown-item" href="#">Other Course Marks</a></li>
                                                    <li><a class="dropdown-item" href="#">Displine Marks</a></li>
                                                    <li><a class="dropdown-item" href="#">Social Marks</a></li>
                                                    <li><a class="dropdown-item" href="#">Comment</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    <script>
        const gradeSelectElem = $("#gradesSelector")
        const centerSelectElem = $("#centerSelector")
        const studentProgressResult = $("#studentProgressResult")
        const tbodyResult = $("tbody[id=studentsResultsMarks]")

        $(() => {
            getGradesInCenter(centerSelectElem.val())
        })

        centerSelectElem.change((e) => {
            gradeSelectElem.html("")
            getGradesInCenter(e.target.value)
        })

        // retrieve all grades in selected center
        const getGradesInCenter = async (centerId) => {
            const url = `/api/gradesInLearnigCenter/${centerId}`
            const {
                data
            } = await axios.get(url)
            if (data.length !== 0) {
                data.forEach(element => {
                    gradeSelectElem.append(`<option value="${element.grad}">GRADE-${element.grad}</option>`)
                    $("button[type=submit]").attr('disabled', false)
                    gradeSelectElem.attr('disabled', false)
                });

            } else {
                gradeSelectElem.html(`<option disabled selected value="">No data found</option>`)
                $("button[type=submit]").attr('disabled', true)
                gradeSelectElem.attr('disabled', true)
            }
        }

    </script>
@endsection
