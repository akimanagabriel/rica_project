@extends('layouts.app')

@section('title', 'pace requests')
@section('pageTitle', 'PACE REQUESTING/MARKS RECORDING')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pace.student.progress') }}" class="row" method="post">
                @csrf
                <div class="form-floating form-floating-outline col-md-6">
                    <select class="select2 form-select form-select-lg" data-allow-clear="true" id="centerSelector"
                        name="lcId">
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
                    <button class="btn btn-primary" type="submit">view studet</button>
                </div>

            </form>
        </div>
    </div>

    {{-- student results --}}
    <div class="d-none" id="studentProgressResult">
        {{-- grade scripture --}}
        <div class="mt-3 d-flex justify-content-end" id="scriptureBtn">
            <a class="btn btn-primary text-white" href="{{ route('scripture.index') }}" id="scriptureLink">grade
                scripture</a>
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
                            @isset($students)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>${index+1}</td>
                                        <td>${student.name}</td>
                                        <td>${student.regnumber}</td>
                                        <td>${student.grade}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div>
                                                <button class="btn btn-info btn-sm rounded-pill">result</button>
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
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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

        // retrieve all students from a selected grade
        // $("button[type=submit]").click(async (e) => {
        //     e.preventDefault()
        //     try {
        //         const url = `/api/studentsProgress/${gradeSelectElem.val()}`
        //         const {
        //             data
        //         } = await axios.get(url)
        //         // console.log(data)
        //         if (data.length === 0) {
        //             studentProgressResult.hide()
        //             $.toast({
        //                 heading: 'Error',
        //                 text: 'No students found',
        //                 showHideTransition: 'fade',
        //                 icon: 'error',
        //                 position: 'top-right',
        //                 hideAfter: 5000,
        //             });
        //         } else {
        //             studentProgressResult.removeClass("d-none")
        //             tbodyResult.html("")
        //             // loop through data
        //             data.forEach((student, index) => {
        //                 // assign link to scrptuture btn
        //                 const tableRow = `

    //                 `
        //                 tbodyResult.append(tableRow)
        //             })

        //         }
        //     } catch (err) {
        //         studentProgressResult.hide()
        //         $.toast({
        //             heading: 'Error',
        //             text: err.message,
        //             showHideTransition: 'fade',
        //             icon: 'error',
        //             position: 'top-right',
        //             hideAfter: 5000,
        //         });
        //     }
        // })
    </script>
@endsection
