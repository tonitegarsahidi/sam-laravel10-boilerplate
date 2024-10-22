@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Detail of User')

{{-- MAIN CONTENT PART --}}
@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">

    @include('admin.components.breadcrumb.simple', $breadcrumbs)
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <h5 class="card-header">Disable My Account</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Are you sure you want to deactivate your account?</h6>
                  <p class="mb-0">Once you deactivate your account, there is no going back. Please be certain.</p>
                </div>
              </div>
              <form id="formAccountDeactivation" action="{{ route('user.setting.deactivate') }}" method="POST">
                @csrf
                <div class="form-check mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="accountActivation"
                        id="accountActivation"
                        required
                    />
                    <label class="form-check-label" for="accountActivation">
                        I confirm my account deactivation
                    </label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>

            </div>
          </div>
        </div>
      </div>

</div>

@endsection

@section('footer-code')



@endsection
