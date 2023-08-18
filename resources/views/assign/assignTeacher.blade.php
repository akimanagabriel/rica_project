@extends('layouts.app')

@section('title', 'LC to teacher')
@section('pageTitle', 'ASSIGN LEARNING CENTER TO SUPERVISOR')

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
                    <tr>
                        <td>#</td>
                        <td>learning center</td>
                        <td>supervisor</td>
                        <td>student number</td>
                        <td>student list</td>
                        <td>status</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
