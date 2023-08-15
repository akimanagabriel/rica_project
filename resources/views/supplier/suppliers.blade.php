@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', 'Students list')

@section('content')
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-end mb-1">
            <button class="btn btn-primary btn-sm">
                <span class="mdi mdi-account-multiple-plus-outline"></span>
                &nbsp; new
            </button>
        </div>

        @if (count($suppliers) == 0)
            <div class="alert alert-info">No supplier available </div>
        @else
            <table class="table table-striped" id="studentData">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>avatar</th>
                        <th>supplier</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>date</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 0; @endphp
                    @foreach ($suppliers as $supplier)
                        @php $i++; @endphp
                        <tr>
                            <td>
                                <span class="fw-medium">{{ $i }}</span>
                            </td>
                            <td>
                                <div class="avatar avatar-sm me-2">
                                    <span class="avatar-initial rounded-circle bg-primary">{{ $supplier->sname[0] }}</span>
                                </div>
                            </td>
                            <td>{{ $supplier->sname }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ $supplier->cdate }}</td>
                            <td>
                                @if ($supplier->status)
                                    <div class='badge bg-label-success'>Active</div>
                                @else
                                    <div class='badge bg-label-danger'>Inactive</div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button class="btn btn-primary btn-sm">
                                        <span class="mdi mdi-account-edit-outline"></span>
                                        edit
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <span class="mdi mdi-trash-can-outline"></span>
                                        delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
