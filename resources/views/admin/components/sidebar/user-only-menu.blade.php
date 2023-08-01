{{-- ROLE SPECIFIC MENU -- USER --}}
@if (auth()->user()->hasRole('ROLE_USER'))
{{-- EXAMPLE MENU HEADER FOR GROUPING --}}
@include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'User Menu'])
{{-- USER ONLY MENU --}}
@include('admin.components.sidebar.item', [
    'menuId' => 'menu-operator-pages',
    'menuText' => 'User Management',
    'menuUrl' => url('/user-page'),
    'menuIcon' => 'bx bx-train',
    'subMenuData' => null,
])
@endif
