@extends('admin.template-index')

@section('header-title')
    Sample of UI Button
@endsection

@section('header-code')
@endsection

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-8-tablet">
                <div class="mdc-card">
                    <h6 class="card-title">Text Buttons</h6>
                    <div class="template-demo">
                        <button class="mdc-button">
                            Baseline
                        </button>
                        <button class="mdc-button mdc-button--dense">
                            Dense
                        </button>
                        <button class="mdc-button">
                            <i class="material-icons mdc-button__icon">favorite</i>
                            Icon
                        </button>
                        <a href="#" class="mdc-button">
                            Link
                        </a>
                        <button class="mdc-button text-button--secondary">
                            Secondary
                        </button>
                        <button class="mdc-button text-button--success">
                            Success
                        </button>
                        <button class="mdc-button text-button--info">
                            Info
                        </button>
                        <button class="mdc-button text-button--warning">
                            Warning
                        </button>
                        <button class="mdc-button text-button--light">
                            Light
                        </button>
                        <button class="mdc-button text-button--dark">
                            Dark
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                <div class="mdc-card">
                    <h6 class="card-title">Raised Button</h6>
                    <div class="template-demo">
                        <button class="mdc-button mdc-button--raised">
                            Baseline
                        </button>
                        <button class="mdc-button mdc-button--raised mdc-button--dense">
                            Dense
                        </button>
                        <button class="mdc-button mdc-button--raised">
                            <i class="material-icons mdc-button__icon">favorite</i>
                            Icon
                        </button>
                        <a href="javascript:void(0)" class="mdc-button mdc-button--raised">
                            Link
                        </a>
                        <button class="mdc-button mdc-button--raised filled-button--secondary">
                            Secondary
                        </button>
                        <button class="mdc-button mdc-button--raised filled-button--success">
                            Success
                        </button>
                        <button class="mdc-button mdc-button--raised filled-button--info">
                            Info
                        </button>
                        <button class="mdc-button mdc-button--raised filled-button--warning">
                            Warning
                        </button>
                        <button class="mdc-button mdc-button--raised filled-button--light">
                            Light
                        </button>
                        <button class="mdc-button mdc-button--raised filled-button--dark">
                            Dark
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                <div class="mdc-card">
                    <section class="mdc-card__primary">
                        <h6 class="card-title">Unelevated Button</h6>
                    </section>
                    <section class="mdc-card__supporting-text">
                        <div class="template-demo">
                            <button class="mdc-button mdc-button--unelevated">
                                Baseline
                            </button>
                            <button class="mdc-button mdc-button--unelevated mdc-button--dense">
                                Dense
                            </button>
                            <button class="mdc-button mdc-button--unelevated">
                                <i class="material-icons mdc-button__icon">favorite</i>
                                Icon
                            </button>
                            <a class="mdc-button mdc-button--unelevated">
                                Link
                            </a>
                            <button class="mdc-button mdc-button--unelevated filled-button--secondary">
                                Secondary
                            </button>
                            <button class="mdc-button mdc-button--unelevated filled-button--success">
                                Success
                            </button>
                            <button class="mdc-button mdc-button--unelevated filled-button--info">
                                Info
                            </button>
                            <button class="mdc-button mdc-button--unelevated filled-button--warning">
                                Warning
                            </button>
                            <button class="mdc-button mdc-button--unelevated filled-button--light">
                                Light
                            </button>
                            <button class="mdc-button mdc-button--unelevated filled-button--dark">
                                Dark
                            </button>
                        </div>
                    </section>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                <div class="mdc-card">
                    <section class="mdc-card__primary">
                        <h6 class="card-title">Outlined Button</h6>
                    </section>
                    <section class="mdc-card__supporting-text">
                        <div class="template-demo">
                            <button class="mdc-button mdc-button--outlined">
                                Baseline
                            </button>
                            <button class="mdc-button mdc-button--outlined mdc-button--dense">
                                Dense
                            </button>
                            <button class="mdc-button mdc-button--outlined">
                                <i class="material-icons mdc-button__icon">favorite</i>
                                Icon
                            </button>
                            <a href="javascript:;" class="mdc-button mdc-button--outlined">
                                Link
                            </a>
                            <button class="mdc-button mdc-button--outlined outlined-button--secondary">
                                Secondary
                            </button>
                            <button class="mdc-button mdc-button--outlined outlined-button--success">
                                Success
                            </button>
                            <button class="mdc-button mdc-button--outlined outlined-button--info">
                                Info
                            </button>
                            <button class="mdc-button mdc-button--outlined outlined-button--warning">
                                Warning
                            </button>
                            <button class="mdc-button mdc-button--outlined outlined-button--light">
                                Light
                            </button>
                            <button class="mdc-button mdc-button--outlined outlined-button--dark">
                                Dark
                            </button>
                        </div>
                    </section>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                <div class="mdc-card">
                    <section class="mdc-card__primary">
                        <h6 class="card-title">Icon Button</h6>
                    </section>
                    <section class="mdc-card__supporting-text">
                        <div class="template-demo">
                            <button class="mdc-button mdc-button--raised icon-button">
                                <i class="material-icons mdc-button__icon">favorite</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--secondary">
                                <i class="material-icons mdc-button__icon">delete</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--success">
                                <i class="material-icons mdc-button__icon">colorize</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--info">
                                <i class="material-icons mdc-button__icon">lock</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--warning">
                                <i class="material-icons mdc-button__icon">add</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--light">
                                <i class="material-icons mdc-button__icon">event_available</i>
                            </button>
                            <button class="mdc-button mdc-button--raised icon-button filled-button--dark">
                                <i class="material-icons mdc-button__icon">notifications_none</i>
                            </button>
                            <a href="javascript:;" class="mdc-button mdc-button--raised icon-button">
                                <i class="material-icons mdc-button__icon">get_app</i>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                <div class="mdc-card">
                    <h6 class="card-title mb-4">Dropdown Menu</h6>
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="template-demo">
                                <h6 class="card-sub-title">Default Menu</h6>
                                <div class="menu-button-container">
                                    <button class="mdc-button mdc-menu-button mdc-button--raised">
                                        Toggle Dropdown
                                    </button>
                                    <div class="mdc-menu mdc-menu-surface" tabindex="-1" id="demo-menu">
                                        <ul class="mdc-list" role="menu" aria-hidden="true"
                                            aria-orientation="vertical">
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Back</h6>
                                            </li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Forward</h6>
                                            </li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Reload</h6>
                                            </li>
                                            <li class="mdc-list-divider"></li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Save As..</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="template-demo">
                                <h6 class="card-sub-title">Icon Menu</h6>
                                <div class="menu-button-container">
                                    <button
                                        class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button secondary-filled-button">
                                        <i class="material-icons mdc-button__icon">add</i>
                                    </button>
                                    <div class="mdc-menu mdc-menu-surface" tabindex="-1" id="demo-menu">
                                        <ul class="mdc-list" role="menu" aria-hidden="true"
                                            aria-orientation="vertical">
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Back</h6>
                                            </li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Forward</h6>
                                            </li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Reload</h6>
                                            </li>
                                            <li class="mdc-list-divider"></li>
                                            <li class="mdc-list-item" role="menuitem">
                                                <h6 class="item-subject font-weight-normal">Save As..</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
