{{-- MENU - SUBMENU - SUBSUBMENU  --}}
@props([
    'menuId' => 'menuId1',
    'menuText' => 'Menu Text',
    'menuUrl' => 'Menu URL',
    'menuIcon' => 'bx bx-dock-top',
    'subMenuData' => null,
])

{{-- MenuItemRender --}}

<li class="menu-item {{ request()->fullUrl() == $menuUrl ? ' active' : '' }}">
    @if (is_null($subMenuData))
        <a href="{{$menuUrl}}" class="menu-link">
    @else
        <a href="javascript:void(0);" class="menu-link menu-toggle">
    @endif
    <i class="menu-icon tf-icons {{$menuIcon}}"></i>
    <div data-i18n="{{ $menuText }}">{{ $menuText }}</div>
    </a>
    <!-- {{url()->current()}} -->
    @if (!is_null($subMenuData))
        <ul class="menu-sub">
            @foreach ($subMenuData as $itemSubMenu)
            <li class="menu-item">
                <a href="{{$itemSubMenu['subMenuUrl'] }}" class="menu-link">
                    <div data-i18n="{{$itemSubMenu['subMenuText']}}">{{$itemSubMenu['subMenuText']}} </div>
                </a>
            </li>
            @endforeach
        </ul>
    @endif
</li>
