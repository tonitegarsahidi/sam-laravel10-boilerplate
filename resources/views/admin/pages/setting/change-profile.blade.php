@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Detail of User')

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- FOR BREADCRUMBS --}}
        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        {{-- MAIN PARTS --}}

        <div class="card">

            {{-- FIRST ROW,  FOR TITLE AND ADD BUTTON --}}
            <div class="d-flex justify-content-between">

                <div class="bd-highlight">
                    <h3 class="card-header">CHANGE PROFILE</h3>
                </div>

            </div>

            <div class="row m-2">

                <div class="col-md-8 col-xs-12">
                    <div class="table-responsive text-nowrap">
                        CHANGE PROFILE HERE
                    </div>

                </div>

            </div>




            {{-- ROW FOR ADDITIONAL FUNCTIONALITY BUTTON --}}
            <div class="m-4">
                <a class="btn btn-primary me-2" href="{{ route('user.setting.changePassword') }}"
                    title="update this user">
                    <i class='tf-icons bx bx-pencil me-2'></i>Change Password</a>
                <a class="btn btn-danger me-2" href="{{ route('user.setting.changeProfile') }}"
                    title="delete user">
                    <i class='tf-icons bx bx-trash me-2'></i>Update Profile</a>
            </div>

        </div>
    </div>

@endsection

@section('footer-code')

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@endsection
