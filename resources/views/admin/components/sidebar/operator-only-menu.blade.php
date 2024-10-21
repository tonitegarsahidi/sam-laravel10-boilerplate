  {{-- ROLE SPECIFIC MENU -- OPERATOR --}}
  @if (auth()->user()->hasRole('ROLE_OPERATOR'))
  {{-- EXAMPLE MENU HEADER FOR GROUPING --}}
  @include('admin.components.sidebar.menu-header', ['textMenuHeader' => 'Operator Menu'])
  {{-- OPERATOR ONLY MENU --}}
  @include('admin.components.sidebar.item', [
      'menuId' => 'menu-operator-pages',
      'menuText' => 'Operator',
      'menuUrl' => route('operator-page'),
      'menuIcon' => 'bx bx-train',
      'subMenuData' => null,
  ])
@endif
