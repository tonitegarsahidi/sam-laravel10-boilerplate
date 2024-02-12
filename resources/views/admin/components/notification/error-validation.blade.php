<!-- resources/views/components/validation-error.blade.php -->

@props(['field'])

@error($field)
    <span class="text-danger">{{ $message }}</span><br/>
@enderror
