@extends('layouts.app')

@section('title', 'grade')
@section('pageTitle', 'Pace')

@php
    use App\Models\Pace;

@endphp

@section('content')
    @foreach ($grad as $grads)
        <center>
            <h4 class="page-title"> PACE STORE LIST: GRADE-{{ $grads->grad }} </h4>
        </center>
    @endforeach
    <div class="card">


        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-striped align-start text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CODE</th>
                            <th scope="col">result</th>
                            <th scope="col">NUMBER</th>
                            <th scope="col">TERM</th>
                            <th scope="col">STORE</th>
                            <th scope="col">LICA</th>
                            <th scope="col">RORA</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $result->code }}</td>
                                <td>{{ $result->short }}</td>
                                <td>{{ $result->pacenumber }}</td>
                                <td>{{ $result->term }}</td>
                                @php
                                    $rora = $result->qte - $result->lica;
                                @endphp
                                <td>{{ $result->qte }}</td>
                                <td>{{ $result->lica }}</td>
                                <td>{{ $rora }}</td>
                                <td>
                                    @if ($result->status == 1)
                                        <span class='badge bg-success'>Active</span>
                                    @else
                                        <span class='badge bg-danger'>Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editSubject-{{ $result->id }}">
                                            <span class="mdi mdi-account-edit-outline"></span>
                                            edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#removeCourse-{{ $result->id }}">
                                            <span class="mdi mdi-account-delet e -outline"></span>
                                            Delete
                                        </button>
                                    </div>

                                    {{-- EDIT SUBJECT MODAL --}}
                                    <div class="modal fade" id="editSubject-{{ $result->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('subject.update', encrypt($result->id)) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="text-center mb-4">
                                                            <h3 class="mb-2">PACE INFORMATION UPDATING</h3>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="d-flex flex-column gap-3">
                                                            {{-- result  name --}}
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="col-12">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <div class="form-floating form-floating-outline">
                                                                            <select name="level"
                                                                                class="select2 form-select">
                                                                                <option value="" disabled selected>
                                                                                    SUBJECT</option>
                                                                                @foreach ($subjects as $subject)
                                                                                    <option
                                                                                        @if ($result->course == $subject->id) selected @endif
                                                                                        value="{{ $subject->id }}">
                                                                                        {{ $subject->cousename }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <label
                                                                                for="modalEditUserLanguage">SUBJECT</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- result short name --}}

                                                            <div class="form-floating form-floating-outline">
                                                                <div class="form-floating form-floating-outline">
                                                                    <select name="level" class="select2 form-select">
                                                                        <option value="1"
                                                                            {{ $result->term == '1' ? 'selected' : null }}>
                                                                            1
                                                                        </option>
                                                                        <option value="2"
                                                                            {{ $result->term == '2' ? 'selected' : null }}>
                                                                            2</option>
                                                                        <option value="3"
                                                                            {{ $result->term == '3' ? 'selected' : null }}>
                                                                            3</option>
                                                                        <option value="4"
                                                                            {{ $result->term == '4' ? 'selected' : null }}>
                                                                            4</option>
                                                                    </select>
                                                                    <label for="modalEditUserLanguage">TERM</label>
                                                                </div>
                                                            </div>



                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input value="{{ $result->pacenumber }}"
                                                                        autocomplete="off" type="text" name="pacenumber"
                                                                        class="form-control" placeholder="result shortname">
                                                                    <label for="formValidationPhone">PACE NUMBER
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('shortname')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input value="{{ $result->code }}" autocomplete="off"
                                                                        type="text" name="code" class="form-control"
                                                                        placeholder="result shortname">
                                                                    <label for="formValidationPhone">PACE CODE
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('shortname')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-floating form-floating-outline">
                                                                <div class="form-floating form-floating-outline">
                                                                    <select name="status" class="select2 form-select">
                                                                        <option value="1"
                                                                            {{ $result->status == '1' ? 'selected' : null }}>
                                                                            Active
                                                                        </option>
                                                                        <option value="0"
                                                                            {{ $result->term == '0' ? 'selected' : null }}>
                                                                            Inactive</option>

                                                                    </select>
                                                                    <label for="modalEditUserLanguage">Status</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <span class="mdi mdi-content-save-check-outline"></span>
                                                            Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- END EDIT SUBJECT MODAL --}}
                                    {{-- START DELETE COMFIRM MODAL --}}
                                    <div class="modal fade" id="removeCourse-{{ $result->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('grade.destroy', encrypt($result->id)) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">PACE DELETE
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this pace ?
                                                            <strong>{{ $result->short }}</strong>
                                                            <strong>{{ $result->pacenumber }} TERM
                                                                {{ $result->term }}</strong> ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            data-bs-dismiss="modal">yes</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- END DELETE COMFIRM MODAL --}}
                                </td>






                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endsection
