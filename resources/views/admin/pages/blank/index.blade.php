@extends('admin.template-index')

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h3 class="card-title">I am Blank Page</h3>


                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            {{ $message }}
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
