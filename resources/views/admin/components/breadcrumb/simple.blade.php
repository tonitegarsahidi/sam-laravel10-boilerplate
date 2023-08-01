{{-- MENU - SUBMENU - SUBSUBMENU  --}}
@props([
    'level1text' => 'Level 1',
    'level1url' => '#',
    'level2text' => 'Level 2',
    'level2url' => '#',
    'level3text' => null,
    'level3url' => null,
    'subMenuData' => null,
])

{{-- MenuItemRender --}}

<h4 class="fw-bold py-3 mb-4">
    @if (!is_null($level1text))
        <span class="text-muted fw-light">{{$level1text}} /</span>
    @endif
    @if (!is_null($level3text))
        <span class="text-muted fw-light">{{$level2text}} /</span>
        {{$level3text}}
    @endif
    {{$level2text}}
</h4>
