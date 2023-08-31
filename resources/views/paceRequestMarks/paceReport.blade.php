@extends('layouts.app')

@section('title', 'PACE REPORT')
@section('pageTitle', 'PACE REPORT')

@php
    use App\Models\PaceRequest;
    use App\Models\Pace;
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>set number</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($setInfo as $set)
                            <tr>
                                <td>{{ str_pad($loop->index + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                <td>SET-{{ $set->setnumber }}</td>
                                <td>
                                    {{-- REPORT MODAL --}}
                                    <!-- Button to trigger the modal -->
                                    <button class="btn btn-sm btn-primary" data-bs-target="#setReport{{ $set->id }}"
                                        data-bs-toggle="modal" onclick="setSetNumber({{ $set->setnumber }})" type="button">
                                        reporting
                                    </button>

                                    <!-- Modal -->
                                    <div aria-hidden="true" aria-labelledby="reportModalLabel" class="modal fade"
                                        id="setReport{{ $set->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportModalLabel">PACE SET REPORTING</h5>
                                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                                        type="button"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>COURSE</th>
                                                                <th>PACE NUMBER</th>
                                                                <th>SCORE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @php
                                                                $paceInfo = PaceRequest::select('paceid', 'setnumber', 'marks', 'setstatus')
                                                                    ->where('stid', $set->stid)
                                                                    ->where('year', $set->year)
                                                                    ->where('gradeid', $set->gradeid)
                                                                    ->where('setnumber', $set->setnumber)
                                                                    ->orderBy('paceid', 'asc')
                                                                    ->get();
                                                            @endphp


                                                            @foreach ($paceInfo as $row)
                                                                @php
                                                                    $paceData = Pace::join('course', 'pace.course', '=', 'course.id')
                                                                        ->select('course.short', 'pace.pacenumber')
                                                                        ->where('pace.id', $row->paceid)
                                                                        ->first();
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $paceData->short }}</td>
                                                                    <td>{{ $paceData->pacenumber }}</td>
                                                                    <td>{{ $row->marks }}</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('pace.sendReport') }}" id="reportForm"
                                                        method="POST">
                                                        @csrf
                                                        <input name="stid" type="hidden" value="{{ $set->stid }}">
                                                        <input id="setNumber" name="setnumber" type="hidden"
                                                            value="">
                                                        {{-- set number value set onclick of button  --}}
                                                        <input name="year" type="hidden" value="{{ $set->year }}">
                                                        <input name="grade" type="hidden" value="{{ $set->gradeid }}">
                                                        <input name="current" type="hidden" value="{{ $current }}">
                                                        <button class="btn btn-light" data-bs-dismiss="modal"
                                                            type="button">Close</button>
                                                        <button class="btn btn-primary" id="sendReport" type="submit">Send
                                                            Report</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- auto assign pace number to related hidden input field --}}
    <script>
        function setSetNumber(setNumber) {
            document.getElementById('setNumber').value = setNumber;
        }
    </script>
@endsection
