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

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addUser"
                            class="btn btn-outline-primary flex-1 me-2">New Learning Center</a>


                        <!-- Edit User Modal -->
                        <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body py-3 py-md-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">CREATING LEARNING CENTER</h3>

                                        </div>
                                        <form class="row g-4" method="post" action="{{ route('learning.store') }}">
                                            @csrf
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserName" name="cname"
                                                        class="form-control" placeholder="Learning Center"
                                                        autocomplete="off" />
                                                    <label for="modalEditUserName">Learning Center</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <select class="form-select" name="status" required>
                                                        <option disabled selected value="">Select Status</option>
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
                            <th scope="col">ACTION</th>
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
                                        GRADE {{ $result->grad }}
                                        <button type='button' class='btn btn-danger btn-sm rounded-pill'>Delete</button>
                                        </a> <br><br>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($center->clstatus == 1)
                                        <span class='badge bg-success'>Active</span>
                                    @else
                                        <span class='badge bg-danger'>Inactive</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="dropdown">

                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Service
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#addUser{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span>Add Grade</span></a>
                                            </li>
                                            <li>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editUser{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span>Edit Grade</span></a>
                                            </li>
                                            <li>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#disableUser{{ $center->id }}"
                                                    class="dropdown-item  btn-sm edit-item">
                                                    <span>Disable/Enable</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <div class="modal fade" id="editUser{{ $center->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body py-3 py-md-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">UPDATE LEARNING CENTER</h3>

                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('learning.update', $center->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-12 ">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="modalEditUserFirstName"
                                                                name="cname" class="form-control"
                                                                value="{{ $center->cname }}" />
                                                            <label for="modalEditUserFirstName">Learning Center</label>
                                                        </div>
                                                    </div><br>


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
                                <div class="modal fade" id="disableUser{{ $center->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body py-3 py-md-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">Are You Sure To disable Learning Center</h3>

                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('learning.disable', $center->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <br>


                                                    <div class="col-12 text-center">
                                                        <button type="submit" class="btn btn-danger me-sm-3 me-1">Yes,I
                                                            Disable It</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="addUser{{ $center->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body py-3 py-md-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">ASSIGN GRADE TO LEARNING CENTER</h3>

                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('learning.store', $center->id) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="cid" value={{ $center->id }}>
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline mb-6">
                                                            <select class="form-select" name="graid"
                                                                id="bs-validation-country" required>
                                                                <option disabled selected value="">Select Grade
                                                                </option>
                                                                @foreach ($grades as $grade)
                                                                    <option value="{{ $grade->id }}">GRADE
                                                                        {{ $grade->grad }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="form-label"
                                                                for="bs-validation-country">Grade</label>
                                                            <div class="valid-feedback"> Looks good! </div>
                                                            <div class="invalid-feedback"> Please select Grade</div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <br>


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
