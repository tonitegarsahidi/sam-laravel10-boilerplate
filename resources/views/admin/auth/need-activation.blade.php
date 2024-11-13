@extends('admin.template-blank')

@section('page-title', 'Activation Needed')

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

                        <h4 class="mb-2">We are reviewing your Application, Ninja! 👋</h4>
                        <p class="mb-4">Please wait on 3x24 hours while our staff review your application.</p>
                        @if (config('constant.NEW_USER_NEED_VERIFY_EMAIL'))
                        <p  class="mb-4"> Also don't forget to <strong>verify your email</strong> via link sent through on your inbox.</p>
                        @endif
                        <p  class="mb-4"> Once we approve your application, we'll email you and then you can Login and enjoy our Ninja playground.</p>




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
