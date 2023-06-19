{{-- MENU - SUBMENU - SUBSUBMENU  --}}
@props([
    'menuId'    => 'menuId1',
    'menuText' => 'Menu Text',
    'menuUrl' => 'Menu URL',
    'menuIcon' => 'pages',
    'subMenuData' => null,
])

{{-- MenuItemRender --}}
<div class="mdc-list-item mdc-drawer-item">
    <a class="mdc-expansion-panel-link" href="{{$menuUrl}}"
        data-toggle="expansionPanel" data-target="{{$menuId}}">
        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">{{$menuIcon}}</i>
        {{ $menuText }}
        @if (!is_null($subMenuData))
            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        @endif
    </a>

    @if (!is_null($subMenuData))

        <div class="mdc-expansion-panel" id="{{$menuId}}">
            <nav class="mdc-list mdc-drawer-submenu">
                @foreach ($subMenuData as $itemSubMenu)
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="{{$itemSubMenu["subMenuUrl"]}}">
                            {{$itemSubMenu["subMenuText"]}}
                        </a>
                    </div>
                @endforeach
            </nav>
        </div>

    @endif


</div>
