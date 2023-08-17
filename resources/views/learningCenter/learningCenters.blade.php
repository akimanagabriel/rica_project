@extends('layouts.app')

@section('title', 'learning center')
@section('pageTitle', 'LEARNING CENTER LIST')

@php
    use App\Models\Center;
    use App\Models\Grad;
    use App\Models\LearningCenter;
    
@endphp

@section('content')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">LEARNING CENTER LIST</h4>
                    <div class="d-flex align-items-center">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#newLearningCenter"
                            class="btn btn-outline-primary flex-1 me-2">New Learning Center</a>


                        <!-- Edit User Modal -->
                        <div class="modal fade" id="newLearningCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body py-3 py-md-0">
                                        <div class="text-center mb-4">
                                            <h5 class="mb-2">CREATING LEARNING CENTER</h5>
                                        </div>
                                        <form class="row g-4" method="post" action="{{ route('learning.store') }}">
                                            @csrf
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserName" name="cname"
                                                        class="form-control" placeholder="Learning Center"
                                                        autocomplete="off" required />
                                                    <label for="modalEditUserName">Learning Center</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <select class="form-select" name="status" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Passive</option>

                                                    </select>
                                                    <label class="form-label" for="bs-validation-country">Status</label>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback"> Please select Status</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                                    Changes</button>
                                                <button type="reset" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Edit User Modal -->
                    </div>
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">LEARNING CENTER</th>
                            <th scope="col">GRADE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($centers as $center)
                            <tr>
                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $center->cname }}</td>
                                @php
                                    $results = LearningCenter::select('leaningcenter.id', 'grad.id', 'grad.grad')
                                        ->join('grad', 'grad.id', '=', 'leaningcenter.graid')
                                        ->join('center', 'center.id', '=', 'leaningcenter.cid')
                                        ->where('leaningcenter.cid', $center->id)
                                        ->get();
                                @endphp
                                <td>
                                    @foreach ($results as $result)
                                        <div class="d-flex justify-content-between align-items-center my-1"
                                            style="width:320px">
                                            <span>GRADE {{ $result->grad }}</span>
                                            <button type='button' class='btn btn-danger btn-sm rounded'
                                                data-bs-toggle="modal" data-bs-target="#delete-LC-{{ $center->id }}">
                                                <span class="mdi mdi-trash-can-outline"></span>
                                                Delete
                                            </button>
                                        </div>

                                        {{-- DELETE MODAL --}}
                                        <div class="modal fade" id="delete-LC-{{ $center->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-simple modal-edit-user">
                                                <div class="modal-content p-4">
                                                    <div class="modal-body py-3 py-md-0">
                                                        <div class="text-center mb-4">
                                                            <h6 class="mb-2">Are you sure to delete
                                                                ({{ $center->cname }})
                                                                grade</h6>

                                                        </div>
                                                        <form class="row g-4" method="post"
                                                            action="{{ route('learning.destroy', encrypt($result->id)) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <br>


                                                            <div class="col-12 text-center">
                                                                <button type="submit"
                                                                    class="btn {{ $center->status ? 'btn-danger' : 'btn-primary' }} me-sm-3 me-1">yes</button>
                                                                <button type="reset" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal" aria-label="Close">no</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- END DELETE MODAL --}}
                                    @endforeach
                                </td>
                                <td>
                                    @if ($center->status == 1)
                                        <span class='badge bg-label-success'>Active</span>
                                    @else
                                        <span class='badge bg-label-danger'>Inactive</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="dropdown">

                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            action
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li class="{{ $center->status == 1 ? 'd-block' : 'd-none' }}">
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#addGrade-{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span class="text-dark">
                                                        <span class="mdi mdi-shape-plus-outline"></span>
                                                        Add Grade</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editLC{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span class="text-dark">
                                                        <span class="mdi mdi-pencil-outline"></span>
                                                        Edit</span></a>
                                            </li>
                                            <li>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#disableUser{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span class="text-dark">
                                                        @if ($center->status == 1)
                                                            <span class="mdi mdi-lock-outline"></span> Disable
                                                        @else
                                                            <span class="mdi mdi-lock-open-variant-outline"></span> Enable
                                                        @endif
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <div class="modal fade" id="editLC{{ $center->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content p-3 p-md-2">
                                            <form class="row g-4" method="post"
                                                action="{{ route('learning.update', $center->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="text-center my-4">
                                                        <h5 class="mb-2">UPDATE LEARNING CENTER</h5>

                                                    </div>
                                                    <div class=" ">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="modalEditUserFirstName"
                                                                name="cname" class="form-control"
                                                                value="{{ $center->cname }}" />
                                                            <label for="modalEditUserFirstName">Learning Center</label>
                                                        </div>
                                                    </div><br>


                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                                            Changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
            </div>


            {{-- DISABLE ENABLE COMFIRMATION --}}
            <div class="modal fade" id="disableUser{{ $center->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-simple modal-edit-user">
                    <div class="modal-content p-4">
                        <div class="modal-body py-3 py-md-0">
                            <div class="text-center mb-4">
                                <h6 class="mb-2">Are you sure to {{ $center->status ? 'disable' : 'enable' }}
                                    ({{ $center->cname }}) learning center</>

                            </div>
                            <form class="row g-4" method="post"
                                action="{{ route('learning.disable', encrypt($center->id)) }}">
                                @csrf
                                @method('PUT')
                                <br>


                                <div class="col-12 text-center">
                                    <button type="submit"
                                        class="btn {{ $center->status ? 'btn-danger' : 'btn-primary' }} me-sm-3 me-1">yes</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">no</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ASSIGN GRADE TO LC --}}
            <div class="modal fade" id="addGrade-{{ $center->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content p-3">
                        <form class="row g-4" method="post" action="{{ route('assignGradeToLC') }}">
                            <div class="modal-body py-3 py-md-0">

                                <div class="text-center my-4">
                                    <h5 class="mb-2">ASSIGN GRADE TO LEARNING CENTER</h5>
                                </div>
                                @method('patch')
                                @csrf
                                <input type="hidden" name="cid" value={{ $center->id }}>
                                <div class="">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <select class="form-select" name="graid" id="bs-validation-country" required>
                                            <option disabled selected value="">Select Grade
                                            </option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">GRADE
                                                    {{ $grade->grad }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="bs-validation-country">Grade</label>
                                        <div class="valid-feedback"> Looks good! </div>
                                        <div class="invalid-feedback"> Please select Grade</div>
                                    </div>
                                </div>
                            </div>
                            <br>


                            <div class="modal-footer text-end">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                    Changes</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </tr>
            @endforeach
            </tbody>
            </table>

            <!--/ Edit User Modal -->
            <!--/ Edit User Modal -->
        </div>
    </div>
    </div>
@endsection
