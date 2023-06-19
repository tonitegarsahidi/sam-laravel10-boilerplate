    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
        <div class="mdc-drawer__header">
            <a href="index.html" class="brand-logo">
                {{-- <img src={{ asset('assets/images/logo.svg') }} alt="logo"> --}}
                <h2>{{ config('app.name') }}</h2>
            </a>
        </div>
        <div class="mdc-drawer__content">

            {{-- LOGGED IN USER'S INFORMATION --}}
            @if (auth()->check())
                <div class="user-info">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="email">{{ auth()->user()->email }}</p>
                </div>
            @endif


            <div class="mdc-list-group">
                <nav class="mdc-list mdc-drawer-menu">


                    {{-- DASHBOARD MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-dashboard',
                        'menuText' => 'Dashboard',
                        'menuUrl' => url('/dashboard'),
                        'menuIcon' => 'home',
                        'subMenuData' => null,
                    ])

                    {{-- CHART MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-charts',
                        'menuText' => 'Charts',
                        'menuUrl' => route('sampleChart'),
                        'menuIcon' => 'pie_chart_outlined',
                        'subMenuData' => null,
                    ])

                    {{-- TABLE MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-table',
                        'menuText' => 'Tables',
                        'menuUrl' => route('sampleTable'),
                        'menuIcon' => 'grid_on',
                        'subMenuData' => null,
                    ])

                    {{-- DOCUMENTATION MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-documentation',
                        'menuText' => 'Documentation',
                        'menuUrl' => route('sampleDocumentation'),
                        'menuIcon' => 'description',
                        'subMenuData' => null,
                    ])

                    {{-- FORM MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-forms',
                        'menuText' => 'Forms Basic',
                        'menuUrl' => route('sampleForm'),
                        'menuIcon' => 'track_changes',
                        'subMenuData' => null,
                    ])

                    {{-- FORM MENU UI FEATURES --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-ui-features',
                        'menuText' => 'UI Features',
                        'menuUrl' => '#',
                        'menuIcon' => 'dashboard',
                        'subMenuData' => [
                            [
                                'subMenuText' => 'Button',
                                'subMenuUrl' => route('sampleUiButton'),
                            ],

                            [
                                'subMenuText' => 'Typography',
                                'subMenuUrl' => route('sampleUiTypography'),
                            ],
                        ],
                    ])

                    {{-- SETTING MENU --}}
                    @include('admin.components.sidebar.item', [
                        'menuId' => 'menu-settings', // or you can use Str::random(10),
                        'menuText' => 'Settings',
                        'menuUrl' => '#',
                        'menuIcon' => 'settings',
                        'subMenuData' => null,
                    ])

                    @if (auth()->user()->hasRole('ROLE_ADMIN'))
                        {{-- ADMIN ONLY MENU --}}
                        @include('admin.components.sidebar.item', [
                            'menuId' => 'menu-admin-pages',
                            'menuText' => 'Admin Pages',
                            'menuUrl' => url('/admin-page'),
                            'menuIcon' => 'face',
                            'subMenuData' => null,
                        ])
                    @endif

                    @if (auth()->user()->hasRole('ROLE_OPERATOR'))
                        {{-- OPERATOR ONLY MENU --}}
                        @include('admin.components.sidebar.item', [
                            'menuId' => 'menu-operator-pages',
                            'menuText' => 'Operator Pages',
                            'menuUrl' => url('/operator-page'),
                            'menuIcon' => 'mood',
                            'subMenuData' => null,
                        ])
                    @endif

                    @if (auth()->user()->hasRole('ROLE_USER'))
                        {{-- USER ONLY MENU --}}
                        @include('admin.components.sidebar.item', [
                            'menuId' => 'menu-user-pages',
                            'menuText' => 'User Pages',
                            'menuUrl' => url('/user-page'),
                            'menuIcon' => 'verified_user',
                            'subMenuData' => null,
                        ])
                    @endif


                    {{-- SPECIAL FOR LOGOUT ONLY --}}
                    <div class="mdc-list-item mdc-drawer-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <a class="mdc-expansion-panel-link" href="#" onclick="event.preventDefault();
                        this.closest('form').submit();">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                aria-hidden="true">exit_to_app</i>
                            Logout
                        </a>
                        </form>

                    </div>



                </nav>
            </div>

            <div class="mdc-card premium-card">
                <div class="d-flex align-items-center">
                    <div class="mdc-card icon-card box-shadow-0">
                        <i class="mdi mdi-shield-outline"></i>
                    </div>
                    <div>
                        <p class="mt-0 mb-1 ml-2 font-weight-bold tx-12">Admin Template by Material Dash</p>
                        <p class="mt-0 mb-0 ml-2 tx-10">Pro available</p>
                    </div>
                </div>
                <p class="tx-8 mt-3 mb-1">More elements. More Pages.</p>
                <p class="tx-8 mb-3">Starting from $25.</p>
                <a href="https://www.bootstrapdash.com/product/material-design-admin-template/" target="_blank">
                    <span class="mdc-button mdc-button--raised mdc-button--white">Upgrade to Pro</span>
                </a>
            </div>
        </div>
    </aside>
