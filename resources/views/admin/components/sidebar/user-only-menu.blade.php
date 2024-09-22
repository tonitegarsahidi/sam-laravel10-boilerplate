{{-- ROLE SPECIFIC MENU -- USER --}}
@if (auth()->user()->hasRole('ROLE_USER'))
{{-- EXAMPLE MENU HEADER FOR GROUPING --}}
@include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'User Only Menu'])
{{-- USER ONLY MENU --}}
 {{-- EXAMPLE MENU WITHOUT SUBMENU --}}
        @include('admin.components.sidebar.item', [
            'menuId' => 'menu-settings', // or you can use Str::random(10),
            'menuText' => 'Profile',
            'menuUrl' => route('profile.index'),
            'menuIcon' => 'bx bx-user', //check here for the icons https://boxicons.com/cheatsheet
            'subMenuData' => null,
        ])

@include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'Demo'])
{{-- USER ONLY MENU --}}
 {{-- EXAMPLE MENU WITHOUT SUBMENU --}}
        @include('admin.components.sidebar.item', [
            'menuId' => 'demo-print', // or you can use Str::random(10),
            'menuText' => 'Demo Print',
            'menuUrl' => route('demo.print'),
            'menuIcon' => 'bx bx-printer', //check here for the icons https://boxicons.com/cheatsheet
            'subMenuData' => null,
        ])
@endif
