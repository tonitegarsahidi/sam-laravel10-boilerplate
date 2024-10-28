<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, World!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .jumbotron .row {
            display: flex;
            align-items: center;
        }
    </style>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <img src="{{asset('assets/img/logo/logo.png')}}" style="width: 45px">
            &nbsp;
            <a class="navbar-brand" href="#"><h3>{{config('app.name')}}</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-warning" href="{{ route('login') }}">Login</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <a class="btn btn-light" href="{{ route('register') }}">Register</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <a class="btn btn-dark btn-sm" href="https://github.com/tonitegarsahidi/samboilerplate-11" target="_blank" >Documentation**</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('assets/img/illustrations/hero-samboilerplate.jpeg')}}" alt="Random Image"
                        class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h1 class="display-4 text-right">Hello, Developer!</h1>
                    <p class="text-right">Sure you can modify me as you wants later. I am version : {{ config('constant.SAMBOILERPLATE_VERSION') }}</p>
                </div>
            </div>
        </div>
    </div>
{{-- FEATURES --}}
<div class="container px-4 py-5" id="icon-grid">
    <h2 class="pb-3 text-center border-bottom">Quick Jump on Your Idea!</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 pt-4">
        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-tachometer bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">Ultimate CRUD</h5>
                    <p class="mb-0">CRUD upsized! : Your basic Standard CRUD + Search data, Dynamic paging, Data Sorting, and delete confirm.</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-rocket bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">Simply Architecture</h5>
                    <p class="mb-0">100% Monolithic with built in Blade Engine. It is quick, easily deployable even in a cpanel hosting.</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-group bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">Role based User</h5>
                    <p class="mb-0">From Admin to basic Users, you can define what they can do and what they can access.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 pt-4">
        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-lock bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">Complete Auth</h5>
                    <p class="mb-0">Register, Login, Forgot Password, Verify Email, Config for Restrict login, etc. Plus user Profile setting</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-network-chart bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">Design Pattern </h5>
                    <p class="mb-0">We used Controller - Service - Repository design pattern, to make development easy and more intuitive</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 d-flex flex-column align-items-center text-center">
                <i class="bx bx-code-block bx-md mb-3 text-info"></i>
                <div>
                    <h5 class="fw-bold text-info">High Quality Code</h5>
                    <p class="mb-0">Try-Catch approach, DB Transactions, centraled alert and errors. Oh and Unit Test with > 80% code coverage</p>
                </div>
            </div>
        </div>

        <div class="col



    {{-- FOOTER --}}
    <footer class="footer bg-dark text-light text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-light">
                    {{ config('app.name') }} - clumsily created by SamToni
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
