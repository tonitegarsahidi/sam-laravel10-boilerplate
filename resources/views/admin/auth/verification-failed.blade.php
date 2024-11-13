@extends('admin.template-blank')

@section('page-title', 'Ooops Verification Failed')

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


                        <h4 class="mb-2">Email Verification Failed 👋</h4>
                        <p class="mb-4">Its okay, we can try again...</p>
                            <p class="mb-4"> Simply head to <a href="{{ route('verification.sendForm') }}">
                                    <span>Resent Verification Again</span>
                                </a>.</p>


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
                            <br />
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
