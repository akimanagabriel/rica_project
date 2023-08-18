@extends('layouts.app')

@section('title', 'LC to teacher')
@section('pageTitle', 'ASSIGN LEARNING CENTER TO SUPERVISOR')

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-2">
        <button class="btn btn-primary">assign lc to supervisor</button>
    </div>
    <div class="card">
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>learning center</th>
                        <th>supervisor</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
