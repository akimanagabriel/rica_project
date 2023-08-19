@extends('layouts.app')

@section('title', 'LC to teacher')
@section('pageTitle', 'ASSIGN LEARNING CENTER TO SUPERVISOR')

@php
    use App\Models\Grad;
    use App\Models\Student;
    use App\Models\AssignGradeTeacher;
@endphp

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-2">
        <button class="btn btn-primary" data-bs-target="#assignLCToTeachereacher" data-bs-toggle="modal">assign lc to
            supervisor</button>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>learning center</th>
                            <th>supervisor</th>
                            <th>student number</th>
                            <th>student list</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $item)
                            {{-- GRADE LIST OF CURRENT LC --}}
                            @php
                                $grades = $grades = Grad::select('grad as gradeName')
                                    ->whereIn('id', function ($query) use ($item) {
                                        $query
                                            ->select('graid')
                                            ->from('leaningcenter')
                                            ->where('cid', $item->centerId);
                                    })
                                    ->get();
                            @endphp
                            <tr>
                                <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                <td>{{ Str::ucfirst($item->cname) }}</td>
                                <td>{{ Str::ucfirst($item->supervisor) }}</td>
                                <td>
                                    {{-- CALCULATE A NUMBER OF ALL STD IN SAME LEARNING CENTER --}}
                                    @php
                                        $numberOfStd = 0;
                                    @endphp
                                    @foreach ($grades as $grade)
                                        @php
                                            $numberOfStudentsByGrade = Student::whereIn('grade', [$grade->gradeName])
                                                ->select('grade', DB::raw('COUNT(id) as count'))
                                                ->groupBy('grade')
                                                ->first();

                                            $numberOfStd += $numberOfStudentsByGrade->count;
                                        @endphp
                                    @endforeach
                                    {{ $numberOfStd }}
                                </td>
                                <td>

                                    <div class="d-flex gap-3">
                                        {{-- DISPLAY GRADE AND CORRESPONDING COUNT --}}
                                        @foreach ($grades as $grade)
                                            @php
                                                $numberOfStudentsByGrade = Student::whereIn('grade', [$grade->gradeName])
                                                    ->select('grade', DB::raw('COUNT(id) as count'))
                                                    ->groupBy('grade')
                                                    ->first();

                                                $numberOfStd += $numberOfStudentsByGrade->count;
                                            @endphp
                                            <div>
                                                <button
                                                    class="btn btn-outline-secondary btn-sm rounded-pill text-nowrap d-inline-block position-relative"
                                                    data-bs-target="#gradeModal-{{ $grade->gradeName }}"
                                                    data-bs-toggle="modal" type="button">
                                                    GRADE-{{ $grade->gradeName }}
                                                    <span
                                                        class="badge bg-label-warning position-absolute top-0 rounded-circle start-100 translate-middle">{{ $numberOfStudentsByGrade->count }}</span>
                                                </button>
                                            </div>

                                            {{-- SHOW SINGLE GRADE STUDENTS --}}

                                            <div class="modal" id="gradeModal-{{ $grade->gradeName }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">All students of
                                                                GRADE-{{ $grade->gradeName }}</h4>
                                                            <button class="btn-close" data-bs-dismiss="modal"
                                                                type="button"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            {{-- SELECT ALL STUDENTS IN CERTAIN GRADE --}}
                                                            @php
                                                                $students = Student::where('grade', $grade->gradeName)->get();
                                                            @endphp

                                                            <div class="table-responsive text-nowrap">

                                                                @if (count($students) == 0)
                                                                    <div class="alert alert-info">No students available
                                                                    </div>
                                                                @else
                                                                    <table class="table table-striped" id="studentData">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>profile</th>
                                                                                <th>reg number</th>
                                                                                <th>names</th>
                                                                                <th>date of birth</th>
                                                                                <th>acc year</th>
                                                                                <th>status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="table-border-bottom-0">
                                                                            @foreach ($students as $student)
                                                                                <tr>
                                                                                    <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="avatar me-2">
                                                                                            <span
                                                                                                class="avatar-initial rounded-circle bg-label-primary">{{ $student->name[0] }}</span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>{{ $student->regnumber }}</td>
                                                                                    <td>{{ $student->name }}</td>
                                                                                    <td>{{ $student->dob }}</td>
                                                                                    <td>{{ $student->year }}</td>
                                                                                    <td><span
                                                                                            class="label bg-label-{{ $student->status ? 'success' : 'danger' }}">{{ $student->status ? 'Active' : 'Inactive' }}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @endif
                                                            </div>




                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                                                type="button">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </td>
                                <td>
                                    <div class="badge bg-label-{{ $item->status == 0 ? 'danger' : 'success' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td>
                                    {{-- DELETE MODAL --}}
                                    <button class="btn btn-danger btn-sm" data-bs-target="#deleteModal-{{ $item->id }}"
                                        data-bs-toggle="modal">delete</button>
                                    <form action="{{ route('assign.destroy', encrypt($item->id)) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
                                            id="deleteModal-{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sure to delete the
                                                            records?</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        confirm deletion of this record
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                            type="button">no</button>
                                                        <button class="btn btn-primary" type="submit">yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TO ASSIGN LC TO SUPERVISOR --}}
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="assignLCToTeachereacher"
        tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('assign.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">

                        <div class="d-flex flex-column gap-4">
                            <div class="form-floating form-floating-outline">
                                <select @if (count($remainingCenters) == 0) disabled @endif
                                    class="select2 form-select form-select-lg" data-allow-clear="true" id="select2Basic"
                                    name="centerId" required>
                                    @if (count($remainingCenters) > 0)
                                        @foreach ($remainingCenters as $lc)
                                            <option value="{{ $lc->id }}">{{ $lc->cname }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option selected value="">No data found</option>
                                    @endif
                                </select>
                                <label for="select2Basic">Learning center</label>
                            </div>


                            <div class="form-floating form-floating-outline">
                                <select @if (count($supervisors) == 0) disabled @endif
                                    class="select2 form-select form-select-lg" data-allow-clear="true" id="select2Basic"
                                    name="teacherId">
                                    @if (count($supervisors) > 0)
                                        @foreach ($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected value="">No data found</option>
                                    @endif
                                </select>
                                <label for="select2Basic">Supervisor</label>
                            </div>

                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg" data-allow-clear="true" id="select2Basic"
                                    name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <label for="select2Basic">Status</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
