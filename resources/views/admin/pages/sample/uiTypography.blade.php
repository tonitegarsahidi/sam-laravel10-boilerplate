@extends('admin.template-index')

@section('header-title')
    Sample of UI Typography
@endsection

@section('header-code')
@endsection

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h6 class="card-title mb-2">Typography</h6>
                    <div class="template-demo typography-demo">
                        <div class="mdc-layout-grid__inner align-items-center">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 1
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline1">Headline 1</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 2
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline2">Headline 2</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 3
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline3">Headline 3</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 4
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline4">Headline 4</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 5
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline5">Headline 5</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Heading 6
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--headline6">Headline 6</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Subtitle 1
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--subtitle1">Subtitle 1</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Subtitle 2
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <h1 class="mdc-typography--subtitle2">Subtitle 2</h1>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Body 1
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography--body1">Body 1. Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Quos blanditiis tenetur unde suscipit, quam beatae rerum inventore consectetur,
                                    neque doloribus, cupiditate numquam dignissimos laborum fugiat deleniti? Eum quasi
                                    quidem quibusdam.</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Body 2
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography--body2">Body 2. Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Quos blanditiis tenetur unde suscipit, quam beatae rerum inventore consectetur,
                                    neque doloribus, cupiditate numquam dignissimos laborum fugiat deleniti? Eum quasi
                                    quidem quibusdam.</p>
                            </div>

                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Button text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <span class="mdc-typography--button">Button text</span>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Caption text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <span class="mdc-typography--caption">Caption text</span>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Overline text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <span class="mdc-typography--overline">Overline text</span>
                            </div>

                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Primary text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--primary">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Secondary text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--secondary">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Success text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--success">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Info text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--info">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Warning text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--warning">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Light text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--light">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2 text-muted tx-14">
                                Dark text
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-10">
                                <p class="mdc-typography mdc-theme--dark">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ripple Enabled Buttons Ends -->
        </div>
    </div>
@endsection

@section('footer-code')
@endsection
