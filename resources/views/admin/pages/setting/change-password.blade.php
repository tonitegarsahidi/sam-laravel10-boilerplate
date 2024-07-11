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
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('user.setting.changePassword.do') }}">
                            @csrf


                            {{-- PASSWORD FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="password">Set Password*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', ['field' => 'password'])

                                    {{-- input form --}}
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="..."
                                        value="{{ old('password', isset($password) ? $password : '') }}">
                                </div>
                            </div>

                            {{-- CONFIRM PASSWORD FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="confirmpassword">Confirm Password*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', ['field' => 'confirmpassword'])

                                    {{-- input form --}}
                                    <input type="password" name="confirmpassword" class="form-control" id="confirmpassword"
                                        placeholder="..."
                                        value="{{ old('confirmpassword', isset($confirmpassword) ? $confirmpassword : '') }}"
                                        >
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
