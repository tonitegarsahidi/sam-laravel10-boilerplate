@props(['field', 'sortField', 'sortOrder'])
@if ($sortField === $field)
    <i class='bx {{ $sortOrder == 'asc' ? 'bxs-up-arrow' : 'bxs-down-arrow' }}'></i>
@endif
