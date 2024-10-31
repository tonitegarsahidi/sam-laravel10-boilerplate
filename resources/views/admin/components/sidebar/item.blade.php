{{-- MENU - SUBMENU - SUBSUBMENU  --}}
@props([
    'menuId' => 'menuId1',
    'menuText' => 'Menu Text',
    'menuUrl' => 'Menu URL',
    'menuIcon' => 'bx bx-dock-top',
    'subMenuData' => null,
])

@php
    // Check if any of the subMenuData URLs are part of the current URL for expanding the main menu
    $isExpanded = false;
    if ($subMenuData) {
        foreach ($subMenuData as $item) {
            if (strpos(request()->fullUrl(), $item['subMenuUrl']) !== false) {
                $isExpanded = true;
                break;
            }
        }
    }
@endphp

{{-- MenuItemRender --}}
<li class="menu-item {{ strpos(request()->fullUrl(), $menuUrl) !== false ? ' active' : '' }} {{ $isExpanded ? ' active open' : '' }}">
    @if (is_null($subMenuData))
        <a href="{{ $menuUrl }}" class="menu-link">
    @else
        <a href="javascript:void(0);" class="menu-link menu-toggle">
    @endif
    <i class="menu-icon tf-icons {{ $menuIcon }}"></i>
    <div data-i18n="{{ $menuText }}">{{ $menuText }}</div>
    </a>

    @if (!is_null($subMenuData))
        <ul class="menu-sub {{ $isExpanded ? 'open' : '' }}">
            @foreach ($subMenuData as $itemSubMenu)
                <li class="menu-item {{ strpos(request()->fullUrl(), $itemSubMenu['subMenuUrl']) !== false ? 'active' : '' }}">
                    <a href="{{ $itemSubMenu['subMenuUrl'] }}" class="menu-link">
                        <div data-i18n="{{ $itemSubMenu['subMenuText'] }}">{{ $itemSubMenu['subMenuText'] }}</div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
