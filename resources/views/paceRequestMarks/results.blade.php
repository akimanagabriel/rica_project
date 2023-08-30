@extends('layouts.app')

@section('title', 'pace requests')
@section('pageTitle', 'PACE REQUESTING/MARKS RECORDING')

@section('content')


    {{-- student results --}}
    <div id="studentProgressResult">
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
                                    
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
