@extends('layouts.app')

@section('title', 'users')
@section('pageTitle', 'USER REGISTRATION LIST')

@section('content')
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h4 class="mb-0">User List</h4>
                    <div>
                        <button class="btn btn-primary" data-bs-target="#addUser" data-bs-toggle="modal">add user</button>
                    </div>
                </div>
                <div class="d-flex align-items-center">

                    <!-- Edit User Modal -->
                    <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-simple modal-edit-user">
                            <div class="modal-content p-3">
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <h5 class="mb-2">USER REGISTRATION</h5>
                                    </div>
                                    <form class="row g-4" method="post" action="{{ route('user.store') }}">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="modalEditUserFirstName" name="name"
                                                    class="form-control" placeholder="John Doe" />
                                                <label for="modalEditUserFirstName">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="modalEditUserEmail" name="email"
                                                    class="form-control" placeholder="example@domain.com" />
                                                <label for="modalEditUserEmail">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="modalEditUserName" name="username"
                                                    class="form-control" placeholder="john.doe.007" />
                                                <label for="modalEditUserName">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserPhone" name="phone"
                                                        class="form-control phone-number-mask" placeholder="202 555 0111" />
                                                    <label for="modalEditUserPhone">Phone Number</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating form-floating-outline">
                                                <select name="roles" class="select2 form-select">
                                                    <option value="Admin">
                                                        Admin
                                                    </option>
                                                    <option value="Supervisor">
                                                        Supervisor</option>
                                                    <option value="Rora">
                                                        Rora</option>
                                                </select>
                                                <label for="modalEditUserLanguage">Level</label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                                aria-label="Close">Cancel</button>
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
                        <th scope="col">Names </th>
                        <th scope="col">reg number </th>
                        <th scope="col">Email </th>
                        <th scope="col">Phone </th>
                        <th scope="col">level </th>
                        <th scope="col">status </th>
                        <th scope="col">date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->regnumber ? $item->regnumber : 'N/A' }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->level }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class='badge bg-label-success'>Active</span>
                                @else
                                    <span class='badge bg-label-danger'>Inactive</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d, M Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                        data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#editUser{{ $item->id }}">
                                            Edit
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            data-bs-target="#delete-user-{{ $item->id }}"
                                            data-bs-toggle="modal">Disable/Enable</a>
                                        <a class="dropdown-item" href="#"
                                            data-bs-target="#reset-user-password-{{ $item->id }}"
                                            data-bs-toggle="modal">Reset Password</a>
                                    </div>
                                </div>

                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-simple modal-edit-user">
                                        <div class="modal-content p-3">
                                            <div class="modal-body py-3 py-md-0">
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">Edit User Information</h3>
                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('user.update', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="modalEditUserFirstName"
                                                                name="name" class="form-control"
                                                                value="{{ $item->name }}" />
                                                            <label for="modalEditUserFirstName">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="modalEditUserEmail" name="email"
                                                                class="form-control" value="{{ $item->email }}" />
                                                            <label for="modalEditUserEmail">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="modalEditUserName" name="username"
                                                                class="form-control" value="{{ $item->username }}" />
                                                            <label for="modalEditUserName">Username</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="modalEditUserPhone"
                                                                    name="phone" class="form-control phone-number-mask"
                                                                    value="{{ $item->phone }}" />
                                                                <label for="modalEditUserPhone">Phone Number</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <div class="form-floating form-floating-outline">
                                                                <select name="level" class="select2 form-select">
                                                                    <option value="Admin"
                                                                        {{ $item->level == 'Admin' ? 'selected' : null }}>
                                                                        Admin
                                                                    </option>
                                                                    <option value="Supervisor"
                                                                        {{ $item->level == 'Supervisor' ? 'selected' : null }}>
                                                                        Supervisor</option>
                                                                    <option value="Rora"
                                                                        {{ $item->level == 'Rora' ? 'selected' : null }}>
                                                                        Rora</option>
                                                                </select>
                                                                <label for="modalEditUserLanguage">Level</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 text-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-sm-3 me-1">Save</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Edit User Modal -->

                                {{-- DISABLE MODAL --}}
                                <div class="modal fade" id="delete-user-{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-simple modal-edit-user">
                                        <div class="modal-content p-4">
                                            <div class="modal-body py-3 py-md-0">
                                                <div class="text-center mb-4">
                                                    <p class="mb-2">Are you sure to
                                                        {{ $item->status == 0 ? 'Enable' : 'Disable' }}
                                                        ({{ $item->name }})
                                                    </p>

                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('user.disableEnable', encrypt($item->id)) }}">
                                                    @csrf
                                                    @method('patch')
                                                    <br>


                                                    <div class="col-12 text-center">
                                                        <button type="submit"
                                                            class="btn {{ $item->status ? 'btn-danger' : 'btn-primary' }} me-sm-3 me-1">yes</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal" aria-label="Close">no</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DISABLE MODAL --}}

                                {{-- RESET PASSWORD --}}
                                <div class="modal fade" id="reset-user-password-{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-simple modal-edit-user">
                                        <div class="modal-content p-4">
                                            <div class="modal-body py-3 py-md-0">
                                                <div class="text-center mb-4">
                                                    <p class="mb-2">Are you sure to reset password of <br>
                                                        ({{ $item->name }}) ?
                                                    </p>

                                                </div>
                                                <form class="row g-4" method="post"
                                                    action="{{ route('user.resetPassword', encrypt($item->id)) }}">
                                                    @csrf
                                                    @method('patch')
                                                    <br>


                                                    <div class="col-12 text-center">
                                                        <button type="submit"
                                                            class="btn {{ $item->status ? 'btn-danger' : 'btn-primary' }} me-sm-3 me-1">yes</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal" aria-label="Close">no</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- END RESET PASSWORD MODAL --}}

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
