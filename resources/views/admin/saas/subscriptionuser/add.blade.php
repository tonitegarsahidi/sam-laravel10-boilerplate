@extends('admin/template-base')

@section('page-title', 'Add Subscription - Select Package')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        @if ($userIsSet)
            {{-- MAIN PARTS --}}
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">

                    <div class="card mb-4">
                        @if (isset($alerts))
                            @include('admin.components.notification.general', $alerts)
                        @endif

                        @php
                            $disabled = !$userFound->is_active;
                        @endphp

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Detail of the User</h4>
                        </div>
                        <div class="row m-2">

                            <div class="col-md-8 col-xs-12">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th style="width: 250px;" scope="col" class="bg-secondary text-white">
                                                    Name</th>
                                                <td>{{ $userFound->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-secondary text-white">Email</th>
                                                <td>{{ $userFound->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-secondary text-white">Phone Number</th>
                                                <td>{{ $userFound->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-secondary text-white">Is Active</th>
                                                <td>
                                                    @if ($userFound->is_active)
                                                        <span class="badge rounded-pill bg-success"> Yes </span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger"> No </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Choose Package</h5>
                            <small class="text-muted float-end">* : must be filled</small>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('subscription.user.store') }}">
                                @csrf



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name">User Id*</label>
                                    <div class="col-sm-10">
                                        {{-- form validation error --}}
                                        @include('admin.components.notification.error-validation', [
                                            'field' => 'user',
                                        ])


                                        {{-- input form --}}
                                        <input type="text" name="name" class="form-control" id="name" disabled
                                            placeholder="User" value="{{$userFound->id}}">

                                        <input type="hidden" name="user" value="{{$userFound->id}}">
                                    </div>
                                </div>


                                {{-- PACKAGE FIELD --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="package">Package*</label>
                                    <div class="col-sm-10">
                                        @include('admin.components.notification.error-validation', [
                                            'field' => 'package',
                                        ])
                                        <input type="hidden" name="user" value="{{ $userFound->id }}">
                                        @if ($disabled)
                                            <select class="form-select form-control form-control-lg" name="package"
                                                id="package" disabled>
                                            @else
                                                <select class="form-select form-control form-control-lg" name="package"
                                                    id="package">
                                        @endif

                                        @foreach ($package as $item)
                                            @if ($selectedPackage == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->package_name }}</option>
                                            @else
                                            <option value="{{ $item->id }}">{{ $item->package_name }}</option>
                                            @endif

                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if (!$disabled)
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Add Subscription</button>
                                        </div>
                                    </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection
