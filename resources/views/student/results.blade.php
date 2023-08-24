@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', "SUPERVISOR'S PROGRESS REPORT CARD AND CONGRATULATION CARD")

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('student.ingrade') }}" class="row" method="get">

                <div class="form-floating form-floating-outline col-md-6">
                    <select class="select2 form-select form-select-lg" data-allow-clear="true" id="centerSelector">
                        <option disabled selected value="">-- choose LC --</option>
                        @foreach ($centers as $lc)
                            <option value="{{ $lc->id }}">{{ $lc->cname }}</option>
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
                    <button class="btn btn-primary" type="submit" id="viewstdbtn">view studet</button>
                </div>

            </form>
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
                                                    <input type="hidden" name="studentId" value="{{  $student->id }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">student result</button>
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



    <script>
        const gradeSelectElem = $("#gradesSelector")
        const centerSelectElem = $("#centerSelector")

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
                    $("#viewstdbtn").attr('disabled', false)
                    gradeSelectElem.attr('disabled', false)
                });

            } else {
                gradeSelectElem.html(`<option disabled selected value="">No data found</option>`)
                $("#viewstdbtn").attr('disabled', true)
                gradeSelectElem.attr('disabled', true)
            }
        }
    </script>
@endsection
