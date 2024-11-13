@extends('admin/template-base')

@section('page-title', 'Edit User')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        <div class="row">
            <!-- Edit User Form -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit User</h5>
                        <small class="text-muted float-end">* : must be filled</small>
                    </div>
                    @include('admin.components.notification.error')
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}"  method="POST">
                            @method('PUT')
                            @csrf

                            {{-- NAME FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Full Name*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'name',
                                    ])


                                    {{-- input form --}}
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="John Doe"
                                        value="{{ old('name', isset($user->name) ? $user->name : '') }}">
                                </div>
                            </div>

                            {{-- EMAIL FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">Email*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'email',
                                    ])

                                    {{-- input form --}}
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="johndoe@someemail.com"
                                        value="{{ old('email', isset($user->email) ? $user->email : '') }}">
                                </div>
                            </div>



                            {{-- PHONE NUMBER FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">Phone Number</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'phone_number',
                                    ])

                                    {{-- input form --}}
                                    <input type="text" name="phone_number" class="form-control" id="phone_number"
                                        placeholder="+62..."
                                        value="{{ old('phone_number', isset($user->phone_number) ? $user->phone_number : '') }}">

                                </div>
                            </div>

                            {{-- IS_ACTIVE RADIO BUTTONS --}}
                            <div class="row mb-3">
                                @php
                                    $oldIsActive = old('is_active', $user->is_active);
                                @endphp
                                <label class="col-sm-2 col-form-label" for="is_active">Is Active*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'is_active',
                                    ])

                                    {{-- input form --}}
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_true"
                                            value="1" {{ isset($oldIsActive) && $oldIsActive == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active_true">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_false"
                                            value="0" {{ isset($oldIsActive) && $oldIsActive == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active_false">No</label>
                                    </div>
                                </div>
                            </div>


                            {{-- ROLES CHECKBOXES --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Roles*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'roles',
                                    ])

                                    {{-- Debugging --}}
                                    @php
                                        $userRoles = $user->roles()->pluck('role_master.id')->toArray();
                                        // dd($userRoles);
                                    @endphp

                                    {{-- input form --}}
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                id="role_{{ $role->id }}" value="{{ $role->id }}"
                                                {{ $user->roles() && in_array($role->id, $user->roles()->pluck('role_master.id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_{{ $role->id }}">
                                                {{ $role->role_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>



                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
