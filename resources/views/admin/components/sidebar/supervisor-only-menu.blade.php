{{-- ROLE SPECIFIC MENU -- SUPERVISOR --}}
@if (auth()->user()->hasRole('ROLE_SUPERVISOR'))
    {{-- EXAMPLE MENU HEADER FOR GROUPING --}}
    @include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'Supervisor Menu'])
    {{-- OPERATOR ONLY MENU --}}
    @include('admin.components.sidebar.item', [
        'menuId' => 'menu-operator-pages',
        'menuText' => 'Supervisor',
        'menuUrl' => route('supervisor-page'),
        'menuIcon' => 'bx bx-briefcase-alt',
        'subMenuData' => null,
    ])
@endif
