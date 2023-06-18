@extends('admin.template-blank')

@section('header-code')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endsection

@section('main-content')
    <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
        <main class="auth-page">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet">
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">
                        <div class="mdc-card">

                            <h2 class="text-center">Hop on board!</h2>

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
                            <form method="POST" action="{{ route('register') }}">

                                @csrf
                                <div class="mdc-layout-grid">
                                    <div class="mdc-layout-grid__inner">
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                            <div class="mdc-text-field w-100">
                                                <input class="mdc-text-field__input" id="text-field-hero-input" value="{{old('name')}}" name="name" required>
                                                <div class="mdc-line-ripple"></div>
                                                <label for="text-field-hero-input"
                                                    class="mdc-floating-label">Name</label>
                                            </div>
                                        </div>

                                        <div
                                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                            <div class="mdc-text-field w-100">
                                                <input class="mdc-text-field__input" id="text-field-hero-input" value="{{old('email')}}" name="email" type="email" required>
                                                <div class="mdc-line-ripple"></div>
                                                <label for="text-field-hero-input"
                                                    class="mdc-floating-label">Email</label>
                                            </div>
                                        </div>

                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                            <div class="mdc-text-field w-100">
                                                <input class="mdc-text-field__input" type="password"
                                                    id="text-field-hero-input" name="password" value="{{old('password')}}" required>
                                                <div class="mdc-line-ripple"></div>
                                                <label for="text-field-hero-input"
                                                    class="mdc-floating-label">Password</label>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                            <div class="mdc-text-field w-100">
                                                <input class="mdc-text-field__input" type="password"
                                                    id="text-field-hero-input" name="password_confirmation" required>
                                                <div class="mdc-line-ripple"></div>
                                                <label for="text-field-hero-input"
                                                    class="mdc-floating-label">Password Confirmation</label>
                                            </div>
                                        </div>
                                        <div
                                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                            <div class="mdc-form-field">
                                                <div class="mdc-checkbox">
                                                    <input type="checkbox" class="mdc-checkbox__native-control"
                                                        id="checkbox-1" name="agree" value="{{old('agree')}}" />
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                        </svg>
                                                        <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                </div>
                                                <label for="checkbox-1">I agree the <a href="">Terms and Condition</a></label>
                                            </div>
                                        </div>

                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                            <button type="submit" class="mdc-button mdc-button--raised w-100">
                                                Register
                                            </button>
                                        </div>

                                        <div
                                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center justify-content-end">

                                        </div>
                                        <div
                                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center justify-content-end">
                                            <a href="{{route('login')}}">Already Registered?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet">
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
