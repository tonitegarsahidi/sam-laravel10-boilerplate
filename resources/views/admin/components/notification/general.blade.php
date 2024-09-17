@props(['alerts'])

@foreach ($alerts as $alert)
    <div class="alert alert-{{$alert['type']}} alert-dismissible text-dark" role="alert">
        {{$alert['message']}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endforeach
