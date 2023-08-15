@extends('layouts.app')

@section('title', 'users')
@section('pageTitle', 'USER REGISTRATION LIST')

@section('content')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h4 class="mb-0">User List</h4>
                        <div>
                            <button class="btn btn-primary btn-sm">add user</button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        @can('view-users')
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addUser"
                                class="btn btn-outline-primary flex-1 me-2">Add User</a>
                        @endcan

                        <!-- Edit User Modal -->
                        <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body py-3 py-md-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Edit User Information</h3>
                                            <p class="pt-1">Updating user details will receive a privacy audit.</p>
                                        </div>
                                        <form class="row g-4" method="post" action="{{ route('user.store') }}">
                                            @csrf
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserFirstName" name="name"
                                                        class="form-control" placeholder="John Doe" />
                                                    <label for="modalEditUserFirstName">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
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
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">US (+25)</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" id="modalEditUserPhone" name="phone"
                                                            class="form-control phone-number-mask"
                                                            placeholder="202 555 0111" />
                                                        <label for="modalEditUserPhone">Phone Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="modalEditUserLanguage" name="roles[]"
                                                        class="select2 form-select" multiple>
                                                        <option value="">Select</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="modalEditUserLanguage">Roles</label>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
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
                            <th scope="col">Names </th>
                            <th scope="col">reg number </th>
                            <th scope="col">Email </th>
                            <th scope="col">Phone </th>
                            <th scope="col">Username </th>
                            <th scope="col">Created At</th>
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
                                <td>{{ $item->username }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d, M Y') }}</td>
                                <td>
                                    @can('edit-users')
                                        <button data-bs-toggle="modal" data-bs-target="#editUser{{ $item->id }}"
                                            class="btn btn-sm btn-info">Edit</button>
                                    @endcan

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                            <div class="modal-content p-3 p-md-5">
                                                <div class="modal-body py-3 py-md-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    <div class="text-center mb-4">
                                                        <h3 class="mb-2">Edit User Information</h3>
                                                        <p class="pt-1">Updating user details will receive a privacy
                                                            audit.</p>
                                                    </div>
                                                    <form class="row g-4" method="post"
                                                        action="{{ route('user.update', $item->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="modalEditUserFirstName"
                                                                    name="name" class="form-control"
                                                                    value="{{ $item->name }}" />
                                                                <label for="modalEditUserFirstName">Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="modalEditUserEmail"
                                                                    name="email" class="form-control"
                                                                    value="{{ $item->email }}" />
                                                                <label for="modalEditUserEmail">Email</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="modalEditUserName"
                                                                    name="username" class="form-control"
                                                                    value="{{ $item->username }}" />
                                                                <label for="modalEditUserName">Username</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text">US (+25)</span>
                                                                <div class="form-floating form-floating-outline">
                                                                    <input type="text" id="modalEditUserPhone"
                                                                        name="phone"
                                                                        class="form-control phone-number-mask"
                                                                        value="{{ $item->phone }}" />
                                                                    <label for="modalEditUserPhone">Phone Number</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-floating form-floating-outline">
                                                                <select id="" name="roles[]"
                                                                    class="select2 form-select" multiple>
                                                                    <option value="">Select</option>
                                                                    @foreach ($roles as $r)
                                                                        <option
                                                                            @foreach ($item->getRoleNames() as $role) {{ $role == $r->name ? 'selected' : '' }} @endforeach
                                                                            value="{{ $r->name }}">
                                                                            {{ $r->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="modalEditUserLanguage">Roles</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 text-center">
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
