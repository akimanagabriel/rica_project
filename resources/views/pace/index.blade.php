@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'Pace')

@php
    use App\Models\Pace;

@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-striped align-start text-nowrap mb-0" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">GRADES</th>
                                <th scope="col">MIN PACE CODE</th>
                                <th scope="col">MAX PACE CODE</th>
                                <th scope="col">AV PACE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grad as $grads)
                            <tr>
                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>GRADE-{{ $grads->grad }}</td>
                                <td>{{ $grads->lownumber }}</td>
                                <td>{{ $grads->upnumber }}</td>
                                @php
                                $total = Pace::where('grad', $grads->id)->count();
                                @endphp
                                <td>
                                    {{ $total }}
                                </td>
                                <td>
                                    <a href="{{ route('pace.viewpace', ['id' => encrypt($grads->id)]) }}">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal">
                                            <i class="mdi mdi-eye"></i>View
                                        </button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                                    </tbody>
            </table>

        </div>
    </div>
@endsection
