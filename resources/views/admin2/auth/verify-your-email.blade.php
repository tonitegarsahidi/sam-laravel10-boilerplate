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

                            <h2 class="text-center">Verify Your Email!</h2>
                            <div class="row">
                                <div class="col-4">
                                    <img style="width: 100%" src="{{ asset('assets/images/icon/mail-verify.png') }}" alt="icon email verify">

                                </div>
                                <div class="col-8 text-lg">
                                    <p>I know you really want to get started. Just one last step more!</p>
                                    <p>Open your email, and click Verify Your Email link. If you can't find your email, try
                                        to look for in your spam folder.</p>
                                </div>
                            </div>


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
