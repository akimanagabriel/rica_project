@extends('layouts.app')

@section('title', 'Students list')
@section('pageTitle', 'Students list')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">

                <div class="d-flex justify-content-end mb-1">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newSupplier">
                        <span class="mdi mdi-account-multiple-plus-outline"></span>
                        &nbsp; new
                    </button>
                </div>


                {{-- NEW SUPPLIER MODAL --}}
                <div class="modal fade" id="newSupplier" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('supplier.store') }}" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">PACE SUPPLIER REGISTRATION</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @csrf

                                    <div class="d-flex flex-column gap-3">
                                        {{-- supplier name --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ old('sname') }}" autocomplete="off" type="text"
                                                    name="sname" class="form-control" placeholder="Supplier name">
                                                <label for="formValidationPhone">Supplier name</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('sname')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- supplier phone number --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ old('phone') }}" autocomplete="off" type="text"
                                                    name="phone" class="form-control" placeholder="Phone number">
                                                <label for="formValidationPhone">Phone number</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- supplier address --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ old('address') }}" autocomplete="off" type="text"
                                                    name="address" class="form-control" placeholder="Address">
                                                <label for="formValidationPhone">Address</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('address')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- supplier status --}}
                                        <div class="fv-plugins-icon-container">
                                            <div class="form-floating form-floating-outline">
                                                <select name="status" class="form-control">
                                                    <option value="1" class="form-control" placeholder="Status">Active
                                                    </option>
                                                    <option value="0" class="form-control" placeholder="Status">
                                                        Inactive
                                                    </option>
                                                </select>
                                                <label for="formValidationPhone">Status</label>
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="mdi mdi-content-save-check-outline"></span>
                                        Save supplier
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                {{-- END NEW SUPPLIER MODAL --}}
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
                                        <span
                                            class="avatar-initial rounded-circle bg-primary">{{ $supplier->sname[0] }}</span>
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
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editSupplier-{{ $supplier->id }}">
                                            <span class="mdi mdi-account-edit-outline"></span>
                                            edit
                                        </button>
                                        {{-- <button class="btn btn-danger btn-sm"
                                    data-bs-target="#deleteConfirmSupplier-{{ $supplier->id }}" data-bs-toggle="modal">
                                    <span class="mdi mdi-trash-can-outline"></span>
                                    delete
                                </button> --}}
                                    </div>


                                    {{-- DELETE A SUPPLIER  --}}
                                    <div class="modal fade" id="deleteConfirmSupplier-{{ $supplier->id }}">
                                        <div class="modal-dialog">
                                            <form action="{{ route('supplier.destroy', encrypt($supplier->id)) }}"
                                                method="post">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">DELETE SUPPLIER
                                                            (<span class="text-primary">{{ $supplier->sname }}</span>)
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @method('delete')
                                                        @csrf
                                                        <p>Are you sure to delete {{ $supplier->sname }} supplier?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">cancel</button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <span class="mdi mdi-check-circle-outline"></span>
                                                            comfirm
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- END DELETE A SUPPLIER  --}}


                                    {{-- START SUPPLIER EDIT MODAL --}}
                                    <div class="modal fade" id="editSupplier-{{ $supplier->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('supplier.update', encrypt($supplier->id)) }}"
                                                method="post">
                                                @method('put')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">EDIT SUPPLIER
                                                            (<span class="text-primary">{{ $supplier->sname }}</span>)
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        @csrf

                                                        <div class="d-flex flex-column gap-3">
                                                            {{-- supplier name --}}
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input value="{{ $supplier->sname }}"
                                                                        autocomplete="off" type="text" name="sname"
                                                                        class="form-control" placeholder="Supplier name">
                                                                    <label for="formValidationPhone">Supplier name</label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('sname')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            {{-- supplier phone number --}}
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input value="{{ $supplier->phone }}"
                                                                        autocomplete="off" type="text" name="phone"
                                                                        class="form-control" placeholder="Phone number">
                                                                    <label for="formValidationPhone">Phone number</label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('phone')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            {{-- supplier address --}}
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input value="{{ $supplier->address }}"
                                                                        autocomplete="off" type="text" name="address"
                                                                        class="form-control" placeholder="Address">
                                                                    <label for="formValidationPhone">Address</label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('address')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            {{-- supplier status --}}
                                                            <div class="fv-plugins-icon-container">
                                                                <div class="form-floating form-floating-outline">
                                                                    <select name="status" class="form-control">
                                                                        <option value="1" class="form-control"
                                                                            placeholder="Status"
                                                                            {{ $supplier->status == '1' ? 'selected' : '' }}>
                                                                            Active
                                                                        </option>
                                                                        <option value="0" class="form-control"
                                                                            placeholder="Status"
                                                                            {{ $supplier->status == '0' ? 'selected' : '' }}>
                                                                            Inactive
                                                                        </option>
                                                                    </select>
                                                                    <label for="formValidationPhone">Status</label>
                                                                </div>
                                                                <div
                                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                    @error('status')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <span class="mdi mdi-content-save-check-outline"></span>
                                                            Save supplier
                                                        </button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- END NEW SUPPLIER EDIT MODAL --}}




                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    </div>
@endsection
