{{-- MENU - SUBMENU - SUBSUBMENU  --}}
@props([
    'menuId' => 'menuId1',
    'menuText' => 'Menu Text',
    'menuUrl' => 'Menu URL',
    'menuIcon' => 'bx bx-dock-top',
    'subMenuData' => null,
])

@php
    // Check if any of the subMenuData URLs match the current URL
    $isExpanded = false;
    if ($subMenuData) {
        foreach ($subMenuData as $item) {
            if (request()->fullUrlIs($item['subMenuUrl'])) {
                $isExpanded = true;
                break;
            }
        }
    }
@endphp

{{-- MenuItemRender --}}

<li class="menu-item {{ request()->fullUrl() == $menuUrl ? ' active' : '' }} {{ $isExpanded? ' active open': ''}}">
    @if (is_null($subMenuData))
            <a href="{{ $menuUrl }}" class="menu-link">
        @else
            <a href="javascript:void(0);" class="menu-link menu-toggle">
    @endif
    <i class="menu-icon tf-icons {{ $menuIcon }}"></i>
    <div data-i18n="{{ $menuText }}">{{ $menuText }}</div>
    </a>
    <!-- {{ url()->current() }} -->
    @if (!is_null($subMenuData))
        <ul class="menu-sub {{ $isExpanded ? 'open' : '' }}">
            @foreach ($subMenuData as $itemSubMenu)
                <li class="menu-item {{ request()->fullUrlIs($itemSubMenu['subMenuUrl']) ? 'active' : '' }}">
                    <a href="{{ $itemSubMenu['subMenuUrl'] }}" class="menu-link">
                        <div data-i18n="{{ $itemSubMenu['subMenuText'] }}">{{ $itemSubMenu['subMenuText'] }} </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
