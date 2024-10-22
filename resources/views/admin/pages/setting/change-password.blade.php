@extends('admin/template-base')

@section('page-title', 'Change Passwords')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        <div class="row">


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="p-2 bd-highlight">
                        <h3 class="card-header">Change Password</h3>
                    </div>

                    <div class="card-body">
                        {{-- form error DISPLAY --}}

                        @if (isset($alerts))
                            @include('admin.components.notification.general', $alerts)
                        @endif

                        @include('admin.components.notification.error-validation', ['field' => 'name'])

                        <form method="POST" action="{{ route('user.setting.changePassword.do') }}">
                            @csrf

                            <div class="row mb-8">
                                <div class="col-sm-10">
                                    <small class="text-muted float-end">* : must be filled</small>
                                    <h5>First.. lets confirm that this is you </h5>

                                </div>
                            </div>


                            {{-- CURRENT PASSWORD FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="password">Your Current Password*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'currentpassword',
                                    ])

                                    {{-- input form --}}
                                    <input type="password" name="currentpassword" class="form-control" id="currentpassword"
                                        placeholder="..."
                                        value="{{ old('currentpassword', isset($currentpassword) ? $currentpassword : '') }}">
                                </div>
                            </div>

                            <br />
                            <br />
                            <br />

                            <div class="row mb-8">
                                <div class="col-sm-10">
                                    <h5>Now input your new password</h5>
                                </div>
                            </div>

                            <br />


                            {{-- NEW PASSWORD FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="password">Set New Password*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'newpassword',
                                    ])

                                    {{-- input form --}}
                                    <input type="password" name="newpassword" class="form-control" id="newpassword"
                                        placeholder="..."
                                        value="{{ old('newpassword', isset($newpassword) ? $newpassword : '') }}">
                                </div>
                            </div>

                            {{-- CONFIRM PASSWORD FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="confirmpassword">Confirm New Password*</label>
                                <div class="col-sm-10">
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'confirmnewpassword',
                                    ])

                                    {{-- input form --}}
                                    <input type="password" name="confirmnewpassword" class="form-control"
                                        id="confirmnewpassword" placeholder="..."
                                        value="{{ old('confirmnewpassword', isset($confirmnewpassword) ? $confirmnewpassword : '') }}">
                                </div>
                            </div>


                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Change My password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
