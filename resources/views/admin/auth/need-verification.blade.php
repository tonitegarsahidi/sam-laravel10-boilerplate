@extends('admin.template-blank')

@section('page-title', 'Email Verification Needed')

@section('header-code')
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
@endsection


@section('main-content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        @include('admin.auth.logo')

                        <h4 class="mb-2">Please Confirm Yourself, Ninja! 👋</h4>
                        <p class="mb-4">Check your email inbox, we sent you something to verify you are as ninja you are.</p>
                        <p class="mb-4">Been waiting and not got any email? Resent here  <a href="{{ route('verification.sendForm') }}">
                            <span>Resent Email Verification</span>
                        </a>.</p>
                        @if (!config('constant.NEW_USER_STATUS_ACTIVE'))
                        <p  class="mb-4"> Also Our staff might need <strong>verify your application</strong>, We'll confirm to you once it is finish.</p>
                        @endif

                        <!-- Notification element -->
                        @if ($errors->any() || session('loginError'))
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @endif
                                    @if (session('loginError'))
                                        <li>{{ session('loginError') }}</li>
                                    @endif
                                </ul>
                            </div>
                        @endif

                        <!-- Notification element -->
                        @if (session('status'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                            <br/>
                            <span>Already have active account?</span>
                            <a href="{{ route('login') }}">
                                <span>Login</span>
                            </a>
                        </p>

                        <p class="text-center">

                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
