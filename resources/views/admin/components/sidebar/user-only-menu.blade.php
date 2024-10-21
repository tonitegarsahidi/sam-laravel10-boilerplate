{{-- ROLE SPECIFIC MENU -- USER --}}
@if (auth()->user()->hasRole('ROLE_USER'))
    {{-- EXAMPLE MENU HEADER FOR GROUPING --}}
    @include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'User Only Menu'])
    {{-- USER ONLY MENU --}}
    {{-- OPERATOR ONLY MENU --}}
    @include('admin.components.sidebar.item', [
        'menuId' => 'menu-user-pages',
        'menuText' => 'User',
        'menuUrl' => route('user-page'),
        'menuIcon' => 'bx bx-user',
        'subMenuData' => null,
    ])
@endif
