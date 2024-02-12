@props(['type', 'message'])

<div class="alert alert-{{$type}} alert-dismissible text-dark" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

