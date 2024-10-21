@extends('admin/template-base')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="p-2 bd-highlight">
                        <h3 class="card-header">User Profile</h3>
                    </div>
                    @if (isset($alerts))
                        @include('admin.components.notification.general', $alerts)
                    @endif
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $profile && $profile->profile_picture ? asset($profile->profile_picture) : asset('assets/img/avatars/default.png') }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    {{-- form validation error --}}
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'profile_picture',
                                    ])

                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" name="profile_picture"
                                        hidden accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('user.profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Full Name -->
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'name',
                                    ])
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" autofocus />
                                </div>


                                <!-- Email -->
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'email',
                                    ])
                                    <input class="form-control" type="email" id="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" placeholder="john.doe@example.com"
                                        disabled="disabled" />
                                </div>

                                <!-- Organization -->
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Organization</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'organization',
                                    ])
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ old('organization', Auth::user()->organization) }}" />
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'phone_number',
                                    ])
                                    <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                        placeholder="202 555 0111" />
                                </div>

                                <!-- Address -->
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'address',
                                    ])
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $profile->address ?? '') }}" />
                                </div>

                                <!-- City -->
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'city',
                                    ])
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city', $profile->city ?? '') }}" />
                                </div>

                                <!-- Country -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'country',
                                    ])
                                    <select id="country" name="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country }}"
                                                {{ old('country', $profile->country ?? '') == $country ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Gender -->
                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'gender',
                                    ])
                                    <select id="gender" name="gender" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="male"
                                            {{ old('gender', $profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $profile->gender ?? '') == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                    </select>
                                </div>

                                <!-- Date of Birth -->
                                <div class="mb-3 col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    @include('admin.components.notification.error-validation', [
                                        'field' => 'date_of_birth',
                                    ])
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}" />
                                </div>

                                <!-- Save and Cancel Buttons -->
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>

    </div>
@endsection
