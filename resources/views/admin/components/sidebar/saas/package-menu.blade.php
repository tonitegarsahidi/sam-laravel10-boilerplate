{{-- SAAS MENU -- ADMIN ONLY --}}
@if (auth()->user()->hasRole('ROLE_ADMIN'))
{{-- EXAMPLE MENU HEADER FOR GROUPING --}}
@include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'Saas Related'])

{{-- PACKAGE MENU --}}
{{-- EXAMPLE MENU WITH SUB MENU --}}
@include('admin.components.sidebar.item', [
    'menuId' => 'saas-package',
    'menuText' => 'Subscription',
    'menuUrl' => '#',
    'menuIcon' => 'bx bx-package', //check here for the icons https://boxicons.com/cheatsheet
    'subMenuData' => [
        [
            'subMenuText' => 'Package',
            'subMenuUrl' => route('subscription.packages.index'),
        ],
        [
            'subMenuText' => 'Subscription',
            'subMenuUrl' => route('subscription.user.index'),
        ],

        // [
        //     'subMenuText' => 'Change Password',
        //     'subMenuUrl' => route('user.setting.changePassword'),
        // ],
    ],
])

@endif
