@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'UI Sample Blank')

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- FOR BREADCRUMBS --}}
        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        {{-- MAIN PARTS --}}



    </div>

@endsection

@section('footer-code')



@endsection
