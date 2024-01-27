@extends('admin/template-base')


@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        <div class="row">


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add User</h5>
                        <small class="text-muted float-end">* : must be filled</small>
                        @include('admin.components.notification.error')
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.user.add-do') }}">
                            @csrf

                            {{-- NAME FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Full Name*</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="John Doe" value="{{ old('name', isset($name) ? $name : '') }}">
                                </div>
                            </div>

                            {{-- EMAIL FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">Email*</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="johndoe@someemail.com"
                                        value="{{ old('email', isset($email) ? $email : '') }}">
                                </div>
                            </div>

                            {{-- IS_ACTIVE RADIO BUTTONS --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="is_active">Is Active*</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_true"
                                            value="1"
                                            {{ old('is_active', isset($is_active) && $is_active ? 'checked' : '') }}>
                                        <label class="form-check-label" for="is_active_true">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_false"
                                            value="0"
                                            {{ old('is_active', isset($is_active) && !$is_active ? 'checked' : '') }}>
                                        <label class="form-check-label" for="is_active_false">No</label>
                                    </div>
                                </div>
                            </div>

                            {{-- ROLES CHECKBOXES --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Roles*</label>
                                <div class="col-sm-10">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                id="role_{{ $role->id }}" value="{{ $role->id }}"
                                                {{ in_array($role->role_code, ['ROLE_USER']) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_{{ $role->id }}">
                                                {{ $role->role_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>




                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
