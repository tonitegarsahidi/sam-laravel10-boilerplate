@extends('admin/template-base')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.components.breadcrumb.simple', $breadcrumbs)
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Subscription Package</h5>
                        <small class="text-muted float-end">* : must be filled</small>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('subscription.packages.update', $package->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- ALIAS FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="alias">Alias*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'alias'])
                                    <input type="text" name="alias" class="form-control" id="alias" placeholder="unique-alias"
                                        value="{{ old('alias', $package->alias) }}">
                                </div>
                            </div>

                            {{-- PACKAGE NAME FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="package_name">Package Name*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'package_name'])
                                    <input type="text" name="package_name" class="form-control" id="package_name" placeholder="Package Name"
                                        value="{{ old('package_name', $package->package_name) }}">
                                </div>
                            </div>

                            {{-- PACKAGE DESCRIPTION FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="package_description">Package Description*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'package_description'])
                                    <textarea name="package_description" class="form-control" id="package_description"
                                        placeholder="Brief description">{{ old('package_description', $package->package_description) }}</textarea>
                                </div>
                            </div>

                            {{-- PACKAGE PRICE FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="package_price">Package Price*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'package_price'])
                                    <input type="number" name="package_price" class="form-control" id="package_price"
                                        placeholder="0.00" value="{{ old('package_price', $package->package_price) }}" step="0.01">
                                </div>
                            </div>

                            {{-- PACKAGE DURATION DAYS FIELD --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="package_duration_days">Duration (Days)*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'package_duration_days'])
                                    <input type="number" name="package_duration_days" class="form-control" id="package_duration_days"
                                        placeholder="Number of days" value="{{ old('package_duration_days', $package->package_duration_days) }}">
                                </div>
                            </div>

                            {{-- IS_ACTIVE RADIO BUTTONS --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="is_active">Is Active*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'is_active'])
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_true" value="1"
                                            {{ old('is_active', $package->is_active) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active_true">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_false" value="0"
                                            {{ old('is_active', $package->is_active) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active_false">No</label>
                                    </div>
                                </div>
                            </div>

                            {{-- IS_VISIBLE RADIO BUTTONS --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="is_visible">Is Visible*</label>
                                <div class="col-sm-10">
                                    @include('admin.components.notification.error-validation', ['field' => 'is_visible'])
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_visible" id="is_visible_true" value="1"
                                            {{ old('is_visible', $package->is_visible) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_visible_true">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_visible" id="is_visible_false" value="0"
                                            {{ old('is_visible', $package->is_visible) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_visible_false">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Package</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
