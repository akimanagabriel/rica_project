@extends('layouts.app')

@section('title', 'LC to teacher')
@section('pageTitle', 'ASSIGN LEARNING CENTER TO SUPERVISOR')

@php
    use App\Models\Grad;
    use App\Models\Student;
@endphp

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-2">
        <button class="btn btn-primary">assign lc to supervisor</button>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>learning center</th>
                        <th>supervisor</th>
                        <th>student number</th>
                        <th>student list</th>
                        <th>status</th>
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

                                <div class="d-flex gap-4">
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
                                                class="btn btn-outline-secondary btn-sm text-nowrap d-inline-block position-relative"
                                                type="button">
                                                GRADE-{{ $grade->gradeName }}
                                                <span
                                                    class="badge bg-label-warning position-absolute top-0 start-100 translate-middle">{{ $numberOfStudentsByGrade->count }}</span>
                                            </button>
                                        </div>

                                        {{-- SHOW SINGLE GRADE STUDENTS --}}
                                    @endforeach
                                </div>

                            </td>
                            <td>
                                <div class="badge bg-label-{{ $item->status == 0 ? 'danger' : 'success' }}">
                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
